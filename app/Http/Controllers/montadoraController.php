<?php

namespace App\Http\Controllers;

use App\DataTables\montadoraDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemontadoraRequest;
use App\Http\Requests\UpdatemontadoraRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\montadoraRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class montadoraController extends AppBaseController
{
    /** @var  montadoraRepository */
    private $montadoraRepository;
    /** @var  CidadeRepository */
    private $cidadeRepository;
    /** @var  EstadosRepository */
    private $estadosReposirory;

    public function __construct(montadoraRepository $montadoraRepo,CidadeRepository $cidadeRepo, EstadosRepository $estadosRepo)
    {
        $this->montadoraRepository = $montadoraRepo;
        $this->cidadeRepository = $cidadeRepo;
        $this->estadosReposirory = $estadosRepo;
    }

    /**
     * Display a listing of the montadora.
     *
     * @param montadoraDataTable $montadoraDataTable
     * @return Response
     */
    public function index(montadoraDataTable $montadoraDataTable)
    {
        return $montadoraDataTable->render('montadoras.index');
    }

    /**
     * Show the form for creating a new montadora.
     *
     * @return Response
     */
    public function create()
    {
        return view('montadoras.create')->with('estados',$this->estadosReposirory->all()->pluck('uf','id'))
                                             ->with('cidades',$this->cidadeRepository->all()->pluck('nome','id'));
    }

    /**
     * Store a newly created montadora in storage.
     *
     * @param CreatemontadoraRequest $request
     *
     * @return Response
     */
    public function store(CreatemontadoraRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('contrato')) {
            $file_upload = $request->file('contrato');
            $name = time() . '_' . $file_upload->getClientOriginalName();
            $filePath = $file_upload->storeAs('contrato', $name, 'public');
            $input['contrato'] = $filePath;
        }
        $montadora = $this->montadoraRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/montadoras.singular')]));

        return redirect(route('montadoras.index'));
    }

    /**
     * Display the specified montadora.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $montadora = $this->montadoraRepository->find($id);

        if (empty($montadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montadoras.singular')]));

            return redirect(route('montadoras.index'));
        }

        return view('montadoras.show')
            ->with('montadora', $montadora)
            ->with('estados',$this->estadosReposirory->all()->pluck('uf','id'))
            ->with('cidades',$this->cidadeRepository->all()->pluck('nome','id'));
    }

    /**
     * Show the form for editing the specified montadora.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $montadora = $this->montadoraRepository->find($id);

        if (empty($montadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montadoras.singular')]));

            return redirect(route('montadoras.index'));
        }

        return view('montadoras.edit')
            ->with('montadora', $montadora)
            ->with('estados',$this->estadosReposirory->all()->pluck('uf','id'))
            ->with('cidades',$this->cidadeRepository->all()->pluck('nome','id'));
    }

    /**
     * Update the specified montadora in storage.
     *
     * @param  int              $id
     * @param UpdatemontadoraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemontadoraRequest $request)
    {
        $montadora = $this->montadoraRepository->find($id);

        if (empty($montadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montadoras.singular')]));

            return redirect(route('montadoras.index'));

        }
         $input = $request->all();

        if ($request->hasFile('contrato')) {
            $file_upload = $request->file('contrato');
            $name = time() . '_' . $file_upload->getClientOriginalName();
            $filePath = $file_upload->storeAs('contrato', $name, 'public');
            $input['contrato'] = $filePath;
        }

        $montadora = $this->montadoraRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/montadoras.singular')]));

        return redirect(route('montadoras.index'));
    }

    /**
     * Remove the specified montadora from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $montadora = $this->montadoraRepository->find($id);

        if (empty($montadora)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montadoras.singular')]));

            return redirect(route('montadoras.index'));
        }

        $this->montadoraRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/montadoras.singular')]));

        return redirect(route('montadoras.index'));
    }
}
