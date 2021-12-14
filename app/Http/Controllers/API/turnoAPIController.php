<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateturnoAPIRequest;
use App\Http\Requests\API\UpdateturnoAPIRequest;
use App\Models\turno;
use App\Repositories\turnoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class turnoController
 * @package App\Http\Controllers\API
 */

class turnoAPIController extends AppBaseController
{
    /** @var  turnoRepository */
    private $turnoRepository;

    public function __construct(turnoRepository $turnoRepo)
    {
        $this->turnoRepository = $turnoRepo;
    }

    /**
     * Display a listing of the turno.
     * GET|HEAD /turnos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $turnos = $this->turnoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $turnos->toArray(),
            __('messages.retrieved', ['model' => __('models/turnos.plural')])
        );
    }

    /**
     * Store a newly created turno in storage.
     * POST /turnos
     *
     * @param CreateturnoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateturnoAPIRequest $request)
    {
        $input = $request->all();

        $turno = $this->turnoRepository->create($input);

        return $this->sendResponse(
            $turno->toArray(),
            __('messages.saved', ['model' => __('models/turnos.singular')])
        );
    }

    /**
     * Display the specified turno.
     * GET|HEAD /turnos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var turno $turno */
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/turnos.singular')])
            );
        }

        return $this->sendResponse(
            $turno->toArray(),
            __('messages.retrieved', ['model' => __('models/turnos.singular')])
        );
    }

    /**
     * Update the specified turno in storage.
     * PUT/PATCH /turnos/{id}
     *
     * @param int $id
     * @param UpdateturnoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateturnoAPIRequest $request)
    {
        $input = $request->all();

        /** @var turno $turno */
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/turnos.singular')])
            );
        }

        $turno = $this->turnoRepository->update($input, $id);

        return $this->sendResponse(
            $turno->toArray(),
            __('messages.updated', ['model' => __('models/turnos.singular')])
        );
    }

    /**
     * Remove the specified turno from storage.
     * DELETE /turnos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var turno $turno */
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/turnos.singular')])
            );
        }

        $turno->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/turnos.singular')])
        );
    }
}
