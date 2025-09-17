<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenCardIAService;

class OpenCartIntegrationController extends Controller
{
    public function showOrder(int $orderId, OpenCardIAService $apiService)
    {
        try {
            $orderData = $apiService->getOrder($orderId);

            dd($orderData);

            // For now, let's just dump the data to see the API response.
            // In the next step, we will create a view to display this nicely.
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Handle API connection errors gracefully
            return response("<h1>Erro ao conectar com a API OpenCart</h1><p>Por favor, verifique se a URL da API e as credenciais estão corretas no seu arquivo .env.</p><p>Detalhe do erro: " . $e->getMessage(), 500);
        }
    }
}
