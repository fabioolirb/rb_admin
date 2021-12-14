<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateturnoRequest;
use App\Http\Requests\UpdateturnoRequest;
use App\Repositories\turnoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class turnoController extends AppBaseController
{
    /** @var  turnoRepository */
    private $turnoRepository;

    public function __construct(turnoRepository $turnoRepo)
    {
        $this->turnoRepository = $turnoRepo;
    }

    /**
     * Display a listing of the turno.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $turnos = $this->turnoRepository->paginate(10);

        return view('turnos.index')
            ->with('turnos', $turnos);
    }

    /**
     * Show the form for creating a new turno.
     *
     * @return Response
     */
    public function create()
    {
        return view('turnos.create');
    }

    /**
     * Store a newly created turno in storage.
     *
     * @param CreateturnoRequest $request
     *
     * @return Response
     */
    public function store(CreateturnoRequest $request)
    {
        $input = $request->all();

        $turno = $this->turnoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/turnos.singular')]));

        return redirect(route('turnos.index'));
    }

    /**
     * Display the specified turno.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            Flash::error(__('messages.not_found', ['model' => __('models/turnos.singular')]));

            return redirect(route('turnos.index'));
        }

        return view('turnos.show')->with('turno', $turno);
    }

    /**
     * Show the form for editing the specified turno.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            Flash::error(__('messages.not_found', ['model' => __('models/turnos.singular')]));

            return redirect(route('turnos.index'));
        }

        return view('turnos.edit')->with('turno', $turno);
    }

    /**
     * Update the specified turno in storage.
     *
     * @param int $id
     * @param UpdateturnoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateturnoRequest $request)
    {
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            Flash::error(__('messages.not_found', ['model' => __('models/turnos.singular')]));

            return redirect(route('turnos.index'));
        }

        $turno = $this->turnoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/turnos.singular')]));

        return redirect(route('turnos.index'));
    }

    /**
     * Remove the specified turno from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $turno = $this->turnoRepository->find($id);

        if (empty($turno)) {
            Flash::error(__('messages.not_found', ['model' => __('models/turnos.singular')]));

            return redirect(route('turnos.index'));
        }

        $this->turnoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/turnos.singular')]));

        return redirect(route('turnos.index'));
    }
}
