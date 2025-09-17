<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createendereco_clienteAPIRequest;
use App\Http\Requests\API\Updateendereco_clienteAPIRequest;
use App\Models\endereco_cliente;
use App\Repositories\endereco_clienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class endereco_clienteController
 * @package App\Http\Controllers\API
 */

class endereco_clienteAPIController extends AppBaseController
{
    /** @var  endereco_clienteRepository */
    private $enderecoClienteRepository;

    public function __construct(endereco_clienteRepository $enderecoClienteRepo)
    {
        $this->enderecoClienteRepository = $enderecoClienteRepo;
    }

    /**
     * Display a listing of the endereco_cliente.
     * GET|HEAD /enderecoClientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $enderecoClientes = $this->enderecoClienteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $enderecoClientes->toArray(),
            __('messages.retrieved', ['model' => __('models/enderecoClientes.plural')])
        );
    }

    /**
     * Store a newly created endereco_cliente in storage.
     * POST /enderecoClientes
     *
     * @param Createendereco_clienteAPIRequest $request
     *
     * @return Response
     */
    public function store(Createendereco_clienteAPIRequest $request)
    {
        $input = $request->all();

        $enderecoCliente = $this->enderecoClienteRepository->create($input);

        return $this->sendResponse(
            $enderecoCliente->toArray(),
            __('messages.saved', ['model' => __('models/enderecoClientes.singular')])
        );
    }

    /**
     * Display the specified endereco_cliente.
     * GET|HEAD /enderecoClientes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var endereco_cliente $enderecoCliente */
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/enderecoClientes.singular')])
            );
        }

        return $this->sendResponse(
            $enderecoCliente->toArray(),
            __('messages.retrieved', ['model' => __('models/enderecoClientes.singular')])
        );
    }

    /**
     * Update the specified endereco_cliente in storage.
     * PUT/PATCH /enderecoClientes/{id}
     *
     * @param int $id
     * @param Updateendereco_clienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateendereco_clienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var endereco_cliente $enderecoCliente */
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/enderecoClientes.singular')])
            );
        }

        $enderecoCliente = $this->enderecoClienteRepository->update($input, $id);

        return $this->sendResponse(
            $enderecoCliente->toArray(),
            __('messages.updated', ['model' => __('models/enderecoClientes.singular')])
        );
    }

    /**
     * Remove the specified endereco_cliente from storage.
     * DELETE /enderecoClientes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var endereco_cliente $enderecoCliente */
        $enderecoCliente = $this->enderecoClienteRepository->find($id);

        if (empty($enderecoCliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/enderecoClientes.singular')])
            );
        }

        $enderecoCliente->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/enderecoClientes.singular')])
        );
    }
}
