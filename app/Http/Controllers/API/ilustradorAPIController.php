<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateilustradorAPIRequest;
use App\Http\Requests\API\UpdateilustradorAPIRequest;
use App\Models\ilustrador;
use App\Repositories\ilustradorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ilustradorController
 * @package App\Http\Controllers\API
 */

class ilustradorAPIController extends AppBaseController
{
    /** @var  ilustradorRepository */
    private $ilustradorRepository;

    public function __construct(ilustradorRepository $ilustradorRepo)
    {
        $this->ilustradorRepository = $ilustradorRepo;
    }

    /**
     * Display a listing of the ilustrador.
     * GET|HEAD /ilustradors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ilustradors = $this->ilustradorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $ilustradors->toArray(),
            __('messages.retrieved', ['model' => __('models/ilustradors.plural')])
        );
    }

    /**
     * Store a newly created ilustrador in storage.
     * POST /ilustradors
     *
     * @param CreateilustradorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateilustradorAPIRequest $request)
    {
        $input = $request->all();

        $ilustrador = $this->ilustradorRepository->create($input);

        return $this->sendResponse(
            $ilustrador->toArray(),
            __('messages.saved', ['model' => __('models/ilustradors.singular')])
        );
    }

    /**
     * Display the specified ilustrador.
     * GET|HEAD /ilustradors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ilustrador $ilustrador */
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/ilustradors.singular')])
            );
        }

        return $this->sendResponse(
            $ilustrador->toArray(),
            __('messages.retrieved', ['model' => __('models/ilustradors.singular')])
        );
    }

    /**
     * Update the specified ilustrador in storage.
     * PUT/PATCH /ilustradors/{id}
     *
     * @param int $id
     * @param UpdateilustradorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateilustradorAPIRequest $request)
    {
        $input = $request->all();

        /** @var ilustrador $ilustrador */
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/ilustradors.singular')])
            );
        }

        $ilustrador = $this->ilustradorRepository->update($input, $id);

        return $this->sendResponse(
            $ilustrador->toArray(),
            __('messages.updated', ['model' => __('models/ilustradors.singular')])
        );
    }

    /**
     * Remove the specified ilustrador from storage.
     * DELETE /ilustradors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ilustrador $ilustrador */
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/ilustradors.singular')])
            );
        }

        $ilustrador->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/ilustradors.singular')])
        );
    }
}
