<?php

namespace App\Http\Controllers;

use App\DataTables\operadorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateoperadorRequest;
use App\Http\Requests\UpdateoperadorRequest;
use App\Repositories\operadorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class operadorController extends AppBaseController
{
    /** @var  operadorRepository */
    private $operadorRepository;

    public function __construct(operadorRepository $operadorRepo)
    {
        $this->operadorRepository = $operadorRepo;
    }

    /**
     * Display a listing of the operador.
     *
     * @param operadorDataTable $operadorDataTable
     * @return Response
     */
    public function index(operadorDataTable $operadorDataTable)
    {
        return $operadorDataTable->render('operadors.index');
    }

    /**
     * Show the form for creating a new operador.
     *
     * @return Response
     */
    public function create()
    {
        return view('operadors.create');
    }

    /**
     * Store a newly created operador in storage.
     *
     * @param CreateoperadorRequest $request
     *
     * @return Response
     */
    public function store(CreateoperadorRequest $request)
    {
        $input = $request->all();

        $operador = $this->operadorRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/operadors.singular')]));

        return redirect(route('operadors.index'));
    }

    /**
     * Display the specified operador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operador = $this->operadorRepository->find($id);

        if (empty($operador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/operadors.singular')]));

            return redirect(route('operadors.index'));
        }

        return view('operadors.show')->with('operador', $operador);
    }

    /**
     * Show the form for editing the specified operador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operador = $this->operadorRepository->find($id);

        if (empty($operador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/operadors.singular')]));

            return redirect(route('operadors.index'));
        }

        return view('operadors.edit')->with('operador', $operador);
    }

    /**
     * Update the specified operador in storage.
     *
     * @param  int              $id
     * @param UpdateoperadorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateoperadorRequest $request)
    {
        $operador = $this->operadorRepository->find($id);

        if (empty($operador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/operadors.singular')]));

            return redirect(route('operadors.index'));
        }

        $operador = $this->operadorRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/operadors.singular')]));

        return redirect(route('operadors.index'));
    }

    /**
     * Remove the specified operador from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operador = $this->operadorRepository->find($id);

        if (empty($operador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/operadors.singular')]));

            return redirect(route('operadors.index'));
        }

        $this->operadorRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/operadors.singular')]));

        return redirect(route('operadors.index'));
    }
}
