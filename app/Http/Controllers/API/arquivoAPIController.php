<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatearquivoAPIRequest;
use App\Http\Requests\API\UpdatearquivoAPIRequest;
use App\Models\arquivo;
use App\Repositories\arquivoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class arquivoController
 * @package App\Http\Controllers\API
 */

class arquivoAPIController extends AppBaseController
{
    /** @var  arquivoRepository */
    private $arquivoRepository;

    public function __construct(arquivoRepository $arquivoRepo)
    {
        $this->arquivoRepository = $arquivoRepo;
    }

    /**
     * Display a listing of the arquivo.
     * GET|HEAD /arquivos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $arquivos = $this->arquivoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $arquivos->toArray(),
            __('messages.retrieved', ['model' => __('models/arquivos.plural')])
        );
    }

    /**
     * Store a newly created arquivo in storage.
     * POST /arquivos
     *
     * @param CreatearquivoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatearquivoAPIRequest $request)
    {
        $input = $request->all();

        $arquivo = $this->arquivoRepository->create($input);

        return $this->sendResponse(
            $arquivo->toArray(),
            __('messages.saved', ['model' => __('models/arquivos.singular')])
        );
    }

    /**
     * Display the specified arquivo.
     * GET|HEAD /arquivos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var arquivo $arquivo */
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/arquivos.singular')])
            );
        }

        return $this->sendResponse(
            $arquivo->toArray(),
            __('messages.retrieved', ['model' => __('models/arquivos.singular')])
        );
    }

    /**
     * Update the specified arquivo in storage.
     * PUT/PATCH /arquivos/{id}
     *
     * @param int $id
     * @param UpdatearquivoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearquivoAPIRequest $request)
    {
        $input = $request->all();

        /** @var arquivo $arquivo */
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/arquivos.singular')])
            );
        }

        $arquivo = $this->arquivoRepository->update($input, $id);

        return $this->sendResponse(
            $arquivo->toArray(),
            __('messages.updated', ['model' => __('models/arquivos.singular')])
        );
    }

    /**
     * Remove the specified arquivo from storage.
     * DELETE /arquivos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var arquivo $arquivo */
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/arquivos.singular')])
            );
        }

        $arquivo->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/arquivos.singular')])
        );
    }
}
