<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecncAPIRequest;
use App\Http\Requests\API\UpdatecncAPIRequest;
use App\Models\cnc;
use App\Repositories\cncRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cncController
 * @package App\Http\Controllers\API
 */

class cncAPIController extends AppBaseController
{
    /** @var  cncRepository */
    private $cncRepository;

    public function __construct(cncRepository $cncRepo)
    {
        $this->cncRepository = $cncRepo;
    }

    /**
     * Display a listing of the cnc.
     * GET|HEAD /cncs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cncs = $this->cncRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $cncs->toArray(),
            __('messages.retrieved', ['model' => __('models/cncs.plural')])
        );
    }

    /**
     * Store a newly created cnc in storage.
     * POST /cncs
     *
     * @param CreatecncAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecncAPIRequest $request)
    {
        $input = $request->all();

        $cnc = $this->cncRepository->create($input);

        return $this->sendResponse(
            $cnc->toArray(),
            __('messages.saved', ['model' => __('models/cncs.singular')])
        );
    }

    /**
     * Display the specified cnc.
     * GET|HEAD /cncs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cnc $cnc */
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cncs.singular')])
            );
        }

        return $this->sendResponse(
            $cnc->toArray(),
            __('messages.retrieved', ['model' => __('models/cncs.singular')])
        );
    }

    /**
     * Update the specified cnc in storage.
     * PUT/PATCH /cncs/{id}
     *
     * @param int $id
     * @param UpdatecncAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecncAPIRequest $request)
    {
        $input = $request->all();

        /** @var cnc $cnc */
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cncs.singular')])
            );
        }

        $cnc = $this->cncRepository->update($input, $id);

        return $this->sendResponse(
            $cnc->toArray(),
            __('messages.updated', ['model' => __('models/cncs.singular')])
        );
    }

    /**
     * Remove the specified cnc from storage.
     * DELETE /cncs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cnc $cnc */
        $cnc = $this->cncRepository->find($id);

        if (empty($cnc)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cncs.singular')])
            );
        }

        $cnc->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/cncs.singular')])
        );
    }
}
