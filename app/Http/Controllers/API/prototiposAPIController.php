<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateprototiposAPIRequest;
use App\Http\Requests\API\UpdateprototiposAPIRequest;
use App\Models\prototipos;
use App\Repositories\prototiposRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class prototiposController
 * @package App\Http\Controllers\API
 */

class prototiposAPIController extends AppBaseController
{
    /** @var  prototiposRepository */
    private $prototiposRepository;

    public function __construct(prototiposRepository $prototiposRepo)
    {
        $this->prototiposRepository = $prototiposRepo;
    }

    /**
     * Display a listing of the prototipos.
     * GET|HEAD /prototipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $prototipos = $this->prototiposRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $prototipos->toArray(),
            __('messages.retrieved', ['model' => __('models/prototipos.plural')])
        );
    }

    /**
     * Store a newly created prototipos in storage.
     * POST /prototipos
     *
     * @param CreateprototiposAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateprototiposAPIRequest $request)
    {
        $input = $request->all();

        $prototipos = $this->prototiposRepository->create($input);

        return $this->sendResponse(
            $prototipos->toArray(),
            __('messages.saved', ['model' => __('models/prototipos.singular')])
        );
    }

    /**
     * Display the specified prototipos.
     * GET|HEAD /prototipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var prototipos $prototipos */
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/prototipos.singular')])
            );
        }

        return $this->sendResponse(
            $prototipos->toArray(),
            __('messages.retrieved', ['model' => __('models/prototipos.singular')])
        );
    }

    /**
     * Update the specified prototipos in storage.
     * PUT/PATCH /prototipos/{id}
     *
     * @param int $id
     * @param UpdateprototiposAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprototiposAPIRequest $request)
    {
        $input = $request->all();

        /** @var prototipos $prototipos */
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/prototipos.singular')])
            );
        }

        $prototipos = $this->prototiposRepository->update($input, $id);

        return $this->sendResponse(
            $prototipos->toArray(),
            __('messages.updated', ['model' => __('models/prototipos.singular')])
        );
    }

    /**
     * Remove the specified prototipos from storage.
     * DELETE /prototipos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var prototipos $prototipos */
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/prototipos.singular')])
            );
        }

        $prototipos->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/prototipos.singular')])
        );
    }
}
