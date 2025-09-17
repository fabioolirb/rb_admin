<?php

namespace App\Http\Controllers;

use App\DataTables\endereco_clienteDataTable;
use App\Http\Requests;
use App\Http\Requests\Createendereco_clienteRequest;
use App\Http\Requests\Updateendereco_clienteRequest;
use App\Repositories\endereco_clienteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class endereco_clienteController extends AppBaseController
{
    /** @var endereco_clienteRepository $enderecoClienteRepository*/
    private $enderecoClienteRepository;

    public function __construct(endereco_clienteRepository $enderecoClienteRepo)
    {
        $this->enderecoClienteRepository = $enderecoClienteRepo;
    }

    /**
     * Display a listing of the endereco_cliente.
     *
     * @param endereco_clienteDataTable $enderecoClienteDataTable
     *
     * @return Response
     */
    public function index(endereco_clienteDataTable $enderecoClienteDataTable)
    {
        return $enderecoClienteDataTable->render('endereco_clientes.index');
    }

    /**
     * Show the form for creating a new endereco_cliente.
     *
     * @return Response
     */
    public function create()
    {
        return view('endereco_clientes.create');
    }

    /**
     * Store a newly created endereco_cliente in storage.
     *
     * @param Createendereco_clienteRequest $request
     *
     * @return Response
     */
    public function store(Createendereco_clienteRequest $request)
    {
        $input = $request->all();

        $enderecoCliente = $this->enderecoClienteRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/enderecoClientes.singular')]));

        return redirect(route('enderecoClientes.index'));
    }

    /**
     * Display the specified endereco_cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/enderecoClientes.singular')]));

            return redirect(route('enderecoClientes.index'));
        }

        return view('endereco_clientes.show')->with('enderecoCliente', $enderecoCliente);
    }

    /**
     * Show the form for editing the specified endereco_cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/enderecoClientes.singular')]));

            return redirect(route('enderecoClientes.index'));
        }

        return view('endereco_clientes.edit')->with('enderecoCliente', $enderecoCliente);
    }

    /**
     * Update the specified endereco_cliente in storage.
     *
     * @param int $id
     * @param Updateendereco_clienteRequest $request
     *
     * @return Response
     */
    public function update($id, Updateendereco_clienteRequest $request)
    {
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/enderecoClientes.singular')]));

            return redirect(route('enderecoClientes.index'));
        }

        $enderecoCliente = $this->enderecoClienteRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/enderecoClientes.singular')]));

        return redirect(route('enderecoClientes.index'));
    }

    /**
     * Remove the specified endereco_cliente from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            Flash::error(__('messages.not_found', ['model' => __('models/enderecoClientes.singular')]));

            return redirect(route('enderecoClientes.index'));
        }

        $this->enderecoClienteRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/enderecoClientes.singular')]));

        return redirect(route('enderecoClientes.index'));
    }
}
