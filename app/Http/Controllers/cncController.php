<?php

namespace App\Http\Controllers;

use App\DataTables\cncDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecncRequest;
use App\Http\Requests\UpdatecncRequest;
use App\Repositories\cncRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class cncController extends AppBaseController
{
    /** @var cncRepository $cncRepository*/
    private $cncRepository;

    public function __construct(cncRepository $cncRepo)
    {
        $this->cncRepository = $cncRepo;
    }

    /**
     * Display a listing of the cnc.
     *
     * @param cncDataTable $cncDataTable
     *
     * @return Response
     */
    public function index(cncDataTable $cncDataTable)
    {
        return $cncDataTable->render('cncs.index');
    }

    /**
     * Show the form for creating a new cnc.
     *
     * @return Response
     */
    public function create()
    {
        return view('cncs.create');
    }

    /**
     * Store a newly created cnc in storage.
     *
     * @param CreatecncRequest $request
     *
     * @return Response
     */
    public function store(CreatecncRequest $request)
    {
        $input = $request->all();

        $cnc = $this->cncRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cncs.singular')]));

        return redirect(route('cncs.index'));
    }

    /**
     * Display the specified cnc.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cncs.singular')]));

            return redirect(route('cncs.index'));
        }

        return view('cncs.show')->with('cnc', $cnc);
    }

    /**
     * Show the form for editing the specified cnc.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cncs.singular')]));

            return redirect(route('cncs.index'));
        }

        return view('cncs.edit')->with('cnc', $cnc);
    }

    /**
     * Update the specified cnc in storage.
     *
     * @param int $id
     * @param UpdatecncRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecncRequest $request)
    {
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cncs.singular')]));

            return redirect(route('cncs.index'));
        }

        $cnc = $this->cncRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cncs.singular')]));

        return redirect(route('cncs.index'));
    }

    /**
     * Remove the specified cnc from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cncs.singular')]));

            return redirect(route('cncs.index'));
        }

        $this->cncRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cncs.singular')]));

        return redirect(route('cncs.index'));
    }
}
