<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createos_usinagemAPIRequest;
use App\Http\Requests\API\Updateos_usinagemAPIRequest;
use App\Models\os_usinagem;
use App\Repositories\os_usinagemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class os_usinagemController
 * @package App\Http\Controllers\API
 */

class os_usinagemAPIController extends AppBaseController
{
    /** @var  os_usinagemRepository */
    private $osUsinagemRepository;

    public function __construct(os_usinagemRepository $osUsinagemRepo)
    {
        $this->osUsinagemRepository = $osUsinagemRepo;
    }

    /**
     * Display a listing of the os_usinagem.
     * GET|HEAD /osUsinagems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $osUsinagems = $this->osUsinagemRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $osUsinagems->toArray(),
            __('messages.retrieved', ['model' => __('models/osUsinagems.plural')])
        );
    }

    /**
     * Store a newly created os_usinagem in storage.
     * POST /osUsinagems
     *
     * @param Createos_usinagemAPIRequest $request
     *
     * @return Response
     */
    public function store(Createos_usinagemAPIRequest $request)
    {
        $input = $request->all();

        $osUsinagem = $this->osUsinagemRepository->create($input);

        return $this->sendResponse(
            $osUsinagem->toArray(),
            __('messages.saved', ['model' => __('models/osUsinagems.singular')])
        );
    }

    /**
     * Display the specified os_usinagem.
     * GET|HEAD /osUsinagems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var os_usinagem $osUsinagem */
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/osUsinagems.singular')])
            );
        }

        return $this->sendResponse(
            $osUsinagem->toArray(),
            __('messages.retrieved', ['model' => __('models/osUsinagems.singular')])
        );
    }

    /**
     * Update the specified os_usinagem in storage.
     * PUT/PATCH /osUsinagems/{id}
     *
     * @param int $id
     * @param Updateos_usinagemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateos_usinagemAPIRequest $request)
    {
        $input = $request->all();

        /** @var os_usinagem $osUsinagem */
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/osUsinagems.singular')])
            );
        }

        $osUsinagem = $this->osUsinagemRepository->update($input, $id);

        return $this->sendResponse(
            $osUsinagem->toArray(),
            __('messages.updated', ['model' => __('models/osUsinagems.singular')])
        );
    }

    /**
     * Remove the specified os_usinagem from storage.
     * DELETE /osUsinagems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var os_usinagem $osUsinagem */
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/osUsinagems.singular')])
            );
        }

        $osUsinagem->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/osUsinagems.singular')])
        );
    }
}
