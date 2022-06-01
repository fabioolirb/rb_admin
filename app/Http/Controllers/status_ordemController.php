<?php

namespace App\Http\Controllers;

use App\DataTables\status_ordemDataTable;
use App\Http\Requests;
use App\Http\Requests\Createstatus_ordemRequest;
use App\Http\Requests\Updatestatus_ordemRequest;
use App\Repositories\status_ordemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class status_ordemController extends AppBaseController
{
    /** @var  status_ordemRepository */
    private $statusOrdemRepository;

    public function __construct(status_ordemRepository $statusOrdemRepo)
    {
        $this->statusOrdemRepository = $statusOrdemRepo;
    }

    /**
     * Display a listing of the status_ordem.
     *
     * @param status_ordemDataTable $statusOrdemDataTable
     * @return Response
     */
    public function index(status_ordemDataTable $statusOrdemDataTable)
    {
        return $statusOrdemDataTable->render('status_ordems.index');
    }

    /**
     * Show the form for creating a new status_ordem.
     *
     * @return Response
     */
    public function create()
    {
        return view('status_ordems.create');
    }

    /**
     * Store a newly created status_ordem in storage.
     *
     * @param Createstatus_ordemRequest $request
     *
     * @return Response
     */
    public function store(Createstatus_ordemRequest $request)
    {
        $input = $request->all();

        $statusOrdem = $this->statusOrdemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/statusOrdems.singular')]));

        return redirect(route('statusOrdems.index'));
    }

    /**
     * Display the specified status_ordem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statusOrdem = $this->statusOrdemRepository->find($id);

        if (empty($statusOrdem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusOrdems.singular')]));

            return redirect(route('statusOrdems.index'));
        }

        return view('status_ordems.show')->with('statusOrdem', $statusOrdem);
    }

    /**
     * Show the form for editing the specified status_ordem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statusOrdem = $this->statusOrdemRepository->find($id);

        if (empty($statusOrdem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusOrdems.singular')]));

            return redirect(route('statusOrdems.index'));
        }

        return view('status_ordems.edit')->with('statusOrdem', $statusOrdem);
    }

    /**
     * Update the specified status_ordem in storage.
     *
     * @param  int              $id
     * @param Updatestatus_ordemRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestatus_ordemRequest $request)
    {
        $statusOrdem = $this->statusOrdemRepository->find($id);

        if (empty($statusOrdem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusOrdems.singular')]));

            return redirect(route('statusOrdems.index'));
        }

        $statusOrdem = $this->statusOrdemRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/statusOrdems.singular')]));

        return redirect(route('statusOrdems.index'));
    }

    /**
     * Remove the specified status_ordem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statusOrdem = $this->statusOrdemRepository->find($id);

        if (empty($statusOrdem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/statusOrdems.singular')]));

            return redirect(route('statusOrdems.index'));
        }

        $this->statusOrdemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/statusOrdems.singular')]));

        return redirect(route('statusOrdems.index'));
    }
}
