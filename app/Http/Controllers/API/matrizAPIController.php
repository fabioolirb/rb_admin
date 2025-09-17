<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatematrizAPIRequest;
use App\Http\Requests\API\UpdatematrizAPIRequest;
use App\Models\matriz;
use App\Repositories\matrizRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class matrizController
 * @package App\Http\Controllers\API
 */

class matrizAPIController extends AppBaseController
{
    /** @var  matrizRepository */
    private $matrizRepository;

    public function __construct(matrizRepository $matrizRepo)
    {
        $this->matrizRepository = $matrizRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/matrizs",
     *      summary="Get a listing of the matrizs.",
     *      tags={"matriz"},
     *      description="Get all matrizs",
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
     *                  @SWG\Items(ref="#/definitions/matriz")
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
        $matrizs = $this->matrizRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $matrizs->toArray(),
            __('messages.retrieved', ['model' => __('models/matrizs.plural')])
        );
    }

    /**
     * @param CreatematrizAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/matrizs",
     *      summary="Store a newly created matriz in storage",
     *      tags={"matriz"},
     *      description="Store matriz",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="matriz that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/matriz")
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
     *                  ref="#/definitions/matriz"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatematrizAPIRequest $request)
    {
        $input = $request->all();

        $matriz = $this->matrizRepository->create($input);

        return $this->sendResponse(
            $matriz->toArray(),
            __('messages.saved', ['model' => __('models/matrizs.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/matrizs/{id}",
     *      summary="Display the specified matriz",
     *      tags={"matriz"},
     *      description="Get matriz",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of matriz",
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
     *                  ref="#/definitions/matriz"
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
        /** @var matriz $matriz */
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/matrizs.singular')])
            );
        }

        return $this->sendResponse(
            $matriz->toArray(),
            __('messages.retrieved', ['model' => __('models/matrizs.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatematrizAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/matrizs/{id}",
     *      summary="Update the specified matriz in storage",
     *      tags={"matriz"},
     *      description="Update matriz",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of matriz",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="matriz that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/matriz")
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
     *                  ref="#/definitions/matriz"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatematrizAPIRequest $request)
    {
        $input = $request->all();

        /** @var matriz $matriz */
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/matrizs.singular')])
            );
        }

        $matriz = $this->matrizRepository->update($input, $id);

        return $this->sendResponse(
            $matriz->toArray(),
            __('messages.updated', ['model' => __('models/matrizs.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/matrizs/{id}",
     *      summary="Remove the specified matriz from storage",
     *      tags={"matriz"},
     *      description="Delete matriz",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of matriz",
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
        /** @var matriz $matriz */
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/matrizs.singular')])
            );
        }

        $matriz->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/matrizs.singular')])
        );
    }
}
