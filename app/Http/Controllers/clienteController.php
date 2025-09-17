<?php

namespace App\Http\Controllers;

use App\DataTables\clienteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateclienteRequest;
use App\Http\Requests\UpdateclienteRequest;
use App\Repositories\clienteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class clienteController extends AppBaseController
{
    /** @var clienteRepository $clienteRepository*/
    private $clienteRepository;

    public function __construct(clienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * Display a listing of the cliente.
     *
     * @param clienteDataTable $clienteDataTable
     *
     * @return Response
     */
    public function index(clienteDataTable $clienteDataTable)
    {
        return $clienteDataTable->render('clientes.index');
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created cliente in storage.
     *
     * @param CreateclienteRequest $request
     *
     * @return Response
     */
    public function store(CreateclienteRequest $request)
    {
        $input = $request->all();

        $cliente = $this->clienteRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/clientes.singular')]));

        return redirect(route('clientes.index'));
    }

    /**
     * Display the specified cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clientes.singular')]));

            return redirect(route('clientes.index'));
        }

        return view('clientes.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clientes.singular')]));

            return redirect(route('clientes.index'));
        }

        return view('clientes.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified cliente in storage.
     *
     * @param int $id
     * @param UpdateclienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclienteRequest $request)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clientes.singular')]));

            return redirect(route('clientes.index'));
        }

        $cliente = $this->clienteRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/clientes.singular')]));

        return redirect(route('clientes.index'));
    }

    /**
     * Remove the specified cliente from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clientes.singular')]));

            return redirect(route('clientes.index'));
        }

        $this->clienteRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/clientes.singular')]));

        return redirect(route('clientes.index'));
    }
}
