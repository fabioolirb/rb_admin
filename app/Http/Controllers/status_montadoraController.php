<?php

namespace App\Http\Controllers;

use App\DataTables\status_montadoraDataTable;
use App\Http\Requests;
use App\Http\Requests\Createstatus_montadoraRequest;
use App\Http\Requests\Updatestatus_montadoraRequest;
use App\Repositories\status_montadoraRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class status_montadoraController extends AppBaseController
{
    /** @var  status_montadoraRepository */
    private $statusMontadoraRepository;

    public function __construct(status_montadoraRepository $statusMontadoraRepo)
    {
        $this->statusMontadoraRepository = $statusMontadoraRepo;
    }

    /**
     * Display a listing of the status_montadora.
     *
     * @param status_montadoraDataTable $statusMontadoraDataTable
     * @return Response
     */
    public function index(status_montadoraDataTable $statusMontadoraDataTable)
    {
        return $statusMontadoraDataTable->render('status_montadoras.index');
    }

    /**
     * Show the form for creating a new status_montadora.
     *
     * @return Response
     */
    public function create()
    {
        return view('status_montadoras.create');
    }

    /**
     * Store a newly created status_montadora in storage.
     *
     * @param Createstatus_montadoraRequest $request
     *
     * @return Response
     */
    public function store(Createstatus_montadoraRequest $request)
    {
        $input = $request->all();

        $statusMontadora = $this->statusMontadoraRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/statusMontadoras.singular')]));

        return redirect(route('statusMontadoras.index'));
    }

    /**
     * Display the specified status_montadora.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statusMontadora = $this->statusMontadoraRepository->find($id);

        if (empty($statusMontadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontadoras.singular')]));

            return redirect(route('statusMontadoras.index'));
        }

        return view('status_montadoras.show')->with('statusMontadora', $statusMontadora);
    }

    /**
     * Show the form for editing the specified status_montadora.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statusMontadora = $this->statusMontadoraRepository->find($id);

        if (empty($statusMontadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontadoras.singular')]));

            return redirect(route('statusMontadoras.index'));
        }

        return view('status_montadoras.edit')->with('statusMontadora', $statusMontadora);
    }

    /**
     * Update the specified status_montadora in storage.
     *
     * @param  int              $id
     * @param Updatestatus_montadoraRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestatus_montadoraRequest $request)
    {
        $statusMontadora = $this->statusMontadoraRepository->find($id);

        if (empty($statusMontadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontadoras.singular')]));

            return redirect(route('statusMontadoras.index'));
        }

        $statusMontadora = $this->statusMontadoraRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/statusMontadoras.singular')]));

        return redirect(route('statusMontadoras.index'));
    }

    /**
     * Remove the specified status_montadora from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statusMontadora = $this->statusMontadoraRepository->find($id);

        if (empty($statusMontadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontadoras.singular')]));

            return redirect(route('statusMontadoras.index'));
        }

        $this->statusMontadoraRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/statusMontadoras.singular')]));

        return redirect(route('statusMontadoras.index'));
    }
}
