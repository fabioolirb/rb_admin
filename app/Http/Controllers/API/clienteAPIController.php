<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateclienteAPIRequest;
use App\Http\Requests\API\UpdateclienteAPIRequest;
use App\Models\cliente;
use App\Repositories\clienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class clienteController
 * @package App\Http\Controllers\API
 */

class clienteAPIController extends AppBaseController
{
    /** @var  clienteRepository */
    private $clienteRepository;

    public function __construct(clienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * Display a listing of the cliente.
     * GET|HEAD /clientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $clientes = $this->clienteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $clientes->toArray(),
            __('messages.retrieved', ['model' => __('models/clientes.plural')])
        );
    }

    /**
     * Store a newly created cliente in storage.
     * POST /clientes
     *
     * @param CreateclienteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateclienteAPIRequest $request)
    {
        $input = $request->all();

        $cliente = $this->clienteRepository->create($input);

        return $this->sendResponse(
            $cliente->toArray(),
            __('messages.saved', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Display the specified cliente.
     * GET|HEAD /clientes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clientes.singular')])
            );
        }

        return $this->sendResponse(
            $cliente->toArray(),
            __('messages.retrieved', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Update the specified cliente in storage.
     * PUT/PATCH /clientes/{id}
     *
     * @param int $id
     * @param UpdateclienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clientes.singular')])
            );
        }

        $cliente = $this->clienteRepository->update($input, $id);

        return $this->sendResponse(
            $cliente->toArray(),
            __('messages.updated', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Remove the specified cliente from storage.
     * DELETE /clientes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clientes.singular')])
            );
        }

        $cliente->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/clientes.singular')])
        );
    }
}
