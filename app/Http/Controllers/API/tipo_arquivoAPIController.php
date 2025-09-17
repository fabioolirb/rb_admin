<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createtipo_arquivoAPIRequest;
use App\Http\Requests\API\Updatetipo_arquivoAPIRequest;
use App\Models\tipo_arquivo;
use App\Repositories\tipo_arquivoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class tipo_arquivoController
 * @package App\Http\Controllers\API
 */

class tipo_arquivoAPIController extends AppBaseController
{
    /** @var  tipo_arquivoRepository */
    private $tipoArquivoRepository;

    public function __construct(tipo_arquivoRepository $tipoArquivoRepo)
    {
        $this->tipoArquivoRepository = $tipoArquivoRepo;
    }

    /**
     * Display a listing of the tipo_arquivo.
     * GET|HEAD /tipoArquivos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoArquivos = $this->tipoArquivoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $tipoArquivos->toArray(),
            __('messages.retrieved', ['model' => __('models/tipoArquivos.plural')])
        );
    }

    /**
     * Store a newly created tipo_arquivo in storage.
     * POST /tipoArquivos
     *
     * @param Createtipo_arquivoAPIRequest $request
     *
     * @return Response
     */
    public function store(Createtipo_arquivoAPIRequest $request)
    {
        $input = $request->all();

        $tipoArquivo = $this->tipoArquivoRepository->create($input);

        return $this->sendResponse(
            $tipoArquivo->toArray(),
            __('messages.saved', ['model' => __('models/tipoArquivos.singular')])
        );
    }

    /**
     * Display the specified tipo_arquivo.
     * GET|HEAD /tipoArquivos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var tipo_arquivo $tipoArquivo */
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tipoArquivos.singular')])
            );
        }

        return $this->sendResponse(
            $tipoArquivo->toArray(),
            __('messages.retrieved', ['model' => __('models/tipoArquivos.singular')])
        );
    }

    /**
     * Update the specified tipo_arquivo in storage.
     * PUT/PATCH /tipoArquivos/{id}
     *
     * @param int $id
     * @param Updatetipo_arquivoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetipo_arquivoAPIRequest $request)
    {
        $input = $request->all();

        /** @var tipo_arquivo $tipoArquivo */
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tipoArquivos.singular')])
            );
        }

        $tipoArquivo = $this->tipoArquivoRepository->update($input, $id);

        return $this->sendResponse(
            $tipoArquivo->toArray(),
            __('messages.updated', ['model' => __('models/tipoArquivos.singular')])
        );
    }

    /**
     * Remove the specified tipo_arquivo from storage.
     * DELETE /tipoArquivos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var tipo_arquivo $tipoArquivo */
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tipoArquivos.singular')])
            );
        }

        $tipoArquivo->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/tipoArquivos.singular')])
        );
    }
}
