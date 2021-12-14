<?php

namespace App\Http\Controllers;

use App\DataTables\maquinaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemaquinaRequest;
use App\Http\Requests\UpdatemaquinaRequest;
use App\Repositories\maquinaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class maquinaController extends AppBaseController
{
    /** @var  maquinaRepository */
    private $maquinaRepository;

    public function __construct(maquinaRepository $maquinaRepo)
    {
        $this->maquinaRepository = $maquinaRepo;
    }

    /**
     * Display a listing of the maquina.
     *
     * @param maquinaDataTable $maquinaDataTable
     * @return Response
     */
    public function index(maquinaDataTable $maquinaDataTable)
    {
        return $maquinaDataTable->render('maquinas.index');
    }

    /**
     * Show the form for creating a new maquina.
     *
     * @return Response
     */
    public function create()
    {
        return view('maquinas.create');
    }

    /**
     * Store a newly created maquina in storage.
     *
     * @param CreatemaquinaRequest $request
     *
     * @return Response
     */
    public function store(CreatemaquinaRequest $request)
    {
        $input = $request->all();

        $maquina = $this->maquinaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/maquinas.singular')]));

        return redirect(route('maquinas.index'));
    }

    /**
     * Display the specified maquina.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $maquina = $this->maquinaRepository->find($id);

        if (empty($maquina)) {
            Flash::error(__('messages.not_found', ['model' => __('models/maquinas.singular')]));

            return redirect(route('maquinas.index'));
        }

        return view('maquinas.show')->with('maquina', $maquina);
    }

    /**
     * Show the form for editing the specified maquina.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $maquina = $this->maquinaRepository->find($id);

        if (empty($maquina)) {
            Flash::error(__('messages.not_found', ['model' => __('models/maquinas.singular')]));

            return redirect(route('maquinas.index'));
        }

        return view('maquinas.edit')->with('maquina', $maquina);
    }

    /**
     * Update the specified maquina in storage.
     *
     * @param  int              $id
     * @param UpdatemaquinaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemaquinaRequest $request)
    {
        $maquina = $this->maquinaRepository->find($id);

        if (empty($maquina)) {
            Flash::error(__('messages.not_found', ['model' => __('models/maquinas.singular')]));

            return redirect(route('maquinas.index'));
        }

        $maquina = $this->maquinaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/maquinas.singular')]));

        return redirect(route('maquinas.index'));
    }

    /**
     * Remove the specified maquina from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $maquina = $this->maquinaRepository->find($id);

        if (empty($maquina)) {
            Flash::error(__('messages.not_found', ['model' => __('models/maquinas.singular')]));

            return redirect(route('maquinas.index'));
        }

        $this->maquinaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/maquinas.singular')]));

        return redirect(route('maquinas.index'));
    }
}
