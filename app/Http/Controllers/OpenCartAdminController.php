<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenCardIAService;

class OpenCartAdminController extends Controller
{
    protected $openCardIAService;

    public function __construct(OpenCardIAService $openCardIAService)
    {
        $this->openCardIAService = $openCardIAService;
    }

    public function index()
    {
        return view('opencart.index');
    }

    public function updateStatusForm()
    {
        return view('opencart.update_status');
    }

    public function getOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
        ]);

        try {
            $orderData = $this->openCardIAService->getOrder($request->input('order_id'));
            return view('opencart.index', ['orderData' => $orderData]);
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->withErrors(['api_error' => trans('opencart.fields.api_connection_error') . ' ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['api_error' => trans('opencart.fields.unexpected_error') . ' ' . $e->getMessage()]);
        }
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'order_status_id' => 'required|integer',
            'comment' => 'nullable|string',
            'notify' => 'boolean',
            'override' => 'boolean',
        ]);

        try {
            $response = $this->openCardIAService->addOrderHistory(
                $request->input('order_id'),
                $request->input('order_status_id'),
                $request->input('comment'),
                $request->boolean('notify'),
                $request->boolean('override')
            );

            if (isset($response['success'])) {
                return redirect()->back()->with('success', trans('opencart.fields.status_updated_success'));
            } else {
                $errorMessage = isset($response['error']) ? (is_array($response['error']) ? implode('; ', $response['error']) : $response['error']) : trans('opencart.fields.unknown_status_update_error');
                return redirect()->back()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->withErrors(['api_error' => trans('opencart.fields.api_connection_error') . ' ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['api_error' => trans('opencart.fields.unexpected_error') . ' ' . $e->getMessage()]);
        }
    }
}
