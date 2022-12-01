<?php

namespace App\Http\Controllers;

use App\DataTables\celulaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecelulaRequest;
use App\Http\Requests\UpdatecelulaRequest;
use App\Repositories\celulaRepository;
use App\Repositories\maquinaRepository;
use App\Repositories\turnoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class celulaController extends AppBaseController
{
    /** @var celulaRepository $celulaRepository*/
    private $celulaRepository;
    private $turnoRepository ;
    private $maquinaRepository;

    public function __construct(maquinaRepository $maquinaRepo,turnoRepository $turnoRepo ,celulaRepository $celulaRepo)
    {
        $this->celulaRepository = $celulaRepo;
        $this->turnoRepository = $turnoRepo ;
        $this->maquinaRepository = $maquinaRepo;
    }

    /**
     * Display a listing of the celula.
     *
     * @param celulaDataTable $celulaDataTable
     *
     * @return Response
     */
    public function index(celulaDataTable $celulaDataTable)
    {
        return $celulaDataTable->render('celulas.index');
    }

    /**
     * Show the form for creating a new celula.
     *
     * @return Response
     */
    public function create()
    {
        return view('celulas.create')->with([
            'turno'=>$this->turnoRepository->all()->pluck('nome', 'id'),
            'maquina' =>$this->maquinaRepository->all()->pluck('nome', 'id')
        ]);
    }

    /**
     * Store a newly created celula in storage.
     *
     * @param CreatecelulaRequest $request
     *
     * @return Response
     */
    public function store(CreatecelulaRequest $request)
    {
        $input = $request->all();

        $celula = $this->celulaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/celulas.singular')]));

        return redirect(route('celulas.index'));
    }

    /**
     * Display the specified celula.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            Flash::error(__('messages.not_found', ['model' => __('models/celulas.singular')]));
            return redirect(route('celulas.index'));
        }

        return view('celulas.show')->with('celula', $celula);
    }

    /**
     * Show the form for editing the specified celula.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            Flash::error(__('messages.not_found', ['model' => __('models/celulas.singular')]));

            return redirect(route('celulas.index'));
        }

        return view('celulas.edit')->with('celula', $celula);
    }

    /**
     * Update the specified celula in storage.
     *
     * @param int $id
     * @param UpdatecelulaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecelulaRequest $request)
    {
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            Flash::error(__('messages.not_found', ['model' => __('models/celulas.singular')]));

            return redirect(route('celulas.index'));
        }

        $celula = $this->celulaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/celulas.singular')]));

        return redirect(route('celulas.index'));
    }

    /**
     * Remove the specified celula from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $celula = $this->celulaRepository->find($id);

        if (empty($celula)) {
            Flash::error(__('messages.not_found', ['model' => __('models/celulas.singular')]));

            return redirect(route('celulas.index'));
        }

        $this->celulaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/celulas.singular')]));

        return redirect(route('celulas.index'));
    }
}
