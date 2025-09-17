<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecelulaAPIRequest;
use App\Http\Requests\API\UpdatecelulaAPIRequest;
use App\Models\celula;
use App\Repositories\celulaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class celulaController
 * @package App\Http\Controllers\API
 */

class celulaAPIController extends AppBaseController
{
    /** @var  celulaRepository */
    private $celulaRepository;

    public function __construct(celulaRepository $celulaRepo)
    {
        $this->celulaRepository = $celulaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/celulas",
     *      summary="Get a listing of the celulas.",
     *      tags={"celula"},
     *      description="Get all celulas",
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
     *                  @SWG\Items(ref="#/definitions/celula")
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
        $celulas = $this->celulaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $celulas->toArray(),
            __('messages.retrieved', ['model' => __('models/celulas.plural')])
        );
    }

    /**
     * @param CreatecelulaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/celulas",
     *      summary="Store a newly created celula in storage",
     *      tags={"celula"},
     *      description="Store celula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="celula that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/celula")
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
     *                  ref="#/definitions/celula"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatecelulaAPIRequest $request)
    {
        $input = $request->all();

        $celula = $this->celulaRepository->create($input);

        return $this->sendResponse(
            $celula->toArray(),
            __('messages.saved', ['model' => __('models/celulas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/celulas/{id}",
     *      summary="Display the specified celula",
     *      tags={"celula"},
     *      description="Get celula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of celula",
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
     *                  ref="#/definitions/celula"
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
        /** @var celula $celula */
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/celulas.singular')])
            );
        }

        return $this->sendResponse(
            $celula->toArray(),
            __('messages.retrieved', ['model' => __('models/celulas.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatecelulaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/celulas/{id}",
     *      summary="Update the specified celula in storage",
     *      tags={"celula"},
     *      description="Update celula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of celula",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="celula that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/celula")
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
     *                  ref="#/definitions/celula"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatecelulaAPIRequest $request)
    {
        $input = $request->all();

        /** @var celula $celula */
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/celulas.singular')])
            );
        }

        $celula = $this->celulaRepository->update($input, $id);

        return $this->sendResponse(
            $celula->toArray(),
            __('messages.updated', ['model' => __('models/celulas.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/celulas/{id}",
     *      summary="Remove the specified celula from storage",
     *      tags={"celula"},
     *      description="Delete celula",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of celula",
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
        /** @var celula $celula */
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/celulas.singular')])
            );
        }

        $celula->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/celulas.singular')])
        );
    }
}
