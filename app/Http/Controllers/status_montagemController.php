<?php

namespace App\Http\Controllers;

use App\DataTables\status_montagemDataTable;
use App\Http\Requests;
use App\Http\Requests\Createstatus_montagemRequest;
use App\Http\Requests\Updatestatus_montagemRequest;
use App\Repositories\status_montagemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class status_montagemController extends AppBaseController
{
    /** @var  status_montagemRepository */
    private $statusMontagemRepository;

    public function __construct(status_montagemRepository $statusMontagemRepo)
    {
        $this->statusMontagemRepository = $statusMontagemRepo;
    }

    /**
     * Display a listing of the status_montagem.
     *
     * @param status_montagemDataTable $statusMontagemDataTable
     * @return Response
     */
    public function index(status_montagemDataTable $statusMontagemDataTable)
    {
        return $statusMontagemDataTable->render('status_montagems.index');
    }

    /**
     * Show the form for creating a new status_montagem.
     *
     * @return Response
     */
    public function create()
    {
        return view('status_montagems.create');
    }

    /**
     * Store a newly created status_montagem in storage.
     *
     * @param Createstatus_montagemRequest $request
     *
     * @return Response
     */
    public function store(Createstatus_montagemRequest $request)
    {
        $input = $request->all();

        $statusMontagem = $this->statusMontagemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/statusMontagems.singular')]));

        return redirect(route('statusMontagems.index'));
    }

    /**
     * Display the specified status_montagem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statusMontagem = $this->statusMontagemRepository->find($id);

        if (empty($statusMontagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontagems.singular')]));

            return redirect(route('statusMontagems.index'));
        }

        return view('status_montagems.show')->with('statusMontagem', $statusMontagem);
    }

    /**
     * Show the form for editing the specified status_montagem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statusMontagem = $this->statusMontagemRepository->find($id);

        if (empty($statusMontagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontagems.singular')]));

            return redirect(route('statusMontagems.index'));
        }

        return view('status_montagems.edit')->with('statusMontagem', $statusMontagem);
    }

    /**
     * Update the specified status_montagem in storage.
     *
     * @param  int              $id
     * @param Updatestatus_montagemRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestatus_montagemRequest $request)
    {
        $statusMontagem = $this->statusMontagemRepository->find($id);

        if (empty($statusMontagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontagems.singular')]));

            return redirect(route('statusMontagems.index'));
        }

        $statusMontagem = $this->statusMontagemRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/statusMontagems.singular')]));

        return redirect(route('statusMontagems.index'));
    }

    /**
     * Remove the specified status_montagem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statusMontagem = $this->statusMontagemRepository->find($id);

        if (empty($statusMontagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusMontagems.singular')]));

            return redirect(route('statusMontagems.index'));
        }

        $this->statusMontagemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/statusMontagems.singular')]));

        return redirect(route('statusMontagems.index'));
    }
}
