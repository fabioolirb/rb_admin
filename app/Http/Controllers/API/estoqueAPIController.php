<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateestoqueAPIRequest;
use App\Http\Requests\API\UpdateestoqueAPIRequest;
use App\Models\estoque;
use App\Repositories\estoqueRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class estoqueController
 * @package App\Http\Controllers\API
 */

class estoqueAPIController extends AppBaseController
{
    /** @var  estoqueRepository */
    private $estoqueRepository;

    public function __construct(estoqueRepository $estoqueRepo)
    {
        $this->estoqueRepository = $estoqueRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/estoques",
     *      summary="Get a listing of the estoques.",
     *      tags={"estoque"},
     *      description="Get all estoques",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/estoque")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $estoques = $this->estoqueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $estoques->toArray(),
            __('messages.retrieved', ['model' => __('models/estoques.plural')])
        );
    }

    /**
     * @param CreateestoqueAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/estoques",
     *      summary="Store a newly created estoque in storage",
     *      tags={"estoque"},
     *      description="Store estoque",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="estoque that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/estoque")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/estoque"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateestoqueAPIRequest $request)
    {
        $input = $request->all();

        $estoque = $this->estoqueRepository->create($input);

        return $this->sendResponse(
            $estoque->toArray(),
            __('messages.saved', ['model' => __('models/estoques.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/estoques/{id}",
     *      summary="Display the specified estoque",
     *      tags={"estoque"},
     *      description="Get estoque",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of estoque",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/estoque"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/estoques.singular')])
            );
        }

        return $this->sendResponse(
            $estoque->toArray(),
            __('messages.retrieved', ['model' => __('models/estoques.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateestoqueAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/estoques/{id}",
     *      summary="Update the specified estoque in storage",
     *      tags={"estoque"},
     *      description="Update estoque",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of estoque",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="estoque that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/estoque")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/estoque"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateestoqueAPIRequest $request)
    {
        $input = $request->all();

        /** @var estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/estoques.singular')])
            );
        }

        $estoque = $this->estoqueRepository->update($input, $id);

        return $this->sendResponse(
            $estoque->toArray(),
            __('messages.updated', ['model' => __('models/estoques.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/estoques/{id}",
     *      summary="Remove the specified estoque from storage",
     *      tags={"estoque"},
     *      description="Delete estoque",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of estoque",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/estoques.singular')])
            );
        }

        $estoque->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/estoques.singular')])
        );
    }
}
