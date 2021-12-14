<?php

namespace App\Http\Controllers;

use App\DataTables\CidadeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCidadeRequest;
use App\Http\Requests\UpdateCidadeRequest;
use App\Models\Cidade;
use App\Models\Estados;
use App\Repositories\CidadeRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\RoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CidadeController extends AppBaseController
{
    /** @var  CidadeRepository */
    private $cidadeRepository;
    /** @var  EstadosRepository */
    private $estadosReposirory;

    public function __construct(CidadeRepository $cidadeRepo, EstadosRepository $estadosRepo)
    {
        $this->cidadeRepository = $cidadeRepo;
        $this->estadosReposirory = $estadosRepo;
    }

    /**
     * Display a listing of the Cidade.
     *
     * @param CidadeDataTable $cidadeDataTable
     * @return Response
     */
    public function index(CidadeDataTable $cidadeDataTable )
    {

        return $cidadeDataTable->render('cidades.index');
    }

    /**
     * Show the form for creating a new Cidade.
     *
     * @return Response
     */
    public function create()
    {
        return view('cidades.create')->with('estados',$this->estadosReposirory->all()->pluck('uf','id'));

    }

    /**
     * Store a newly created Cidade in storage.
     *
     * @param CreateCidadeRequest $request
     *
     * @return Response
     */
    public function store(CreateCidadeRequest $request)
    {
        $input = $request->all();

        $cidade = $this->cidadeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cidades.singular')]));

        return redirect(route('cidades.index'));
    }

    /**
     * Display the specified Cidade.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cidade = $this->cidadeRepository->find($id);

        if (empty($cidade)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cidades.singular')]));

            return redirect(route('cidades.index'));
        }

        return view('cidades.show')->with('cidade', $cidade);


    }

    /**
     * Show the form for editing the specified Cidade.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cidade = $this->cidadeRepository->find($id);

        if (empty($cidade)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cidades.singular')]));

            return redirect(route('cidades.index'));
        }


        return view('cidades.edit')->with(['cidade'=>$cidade , 'estados'=>$this->estadosReposirory->all()->pluck('uf','id')]);
    }

    /**
     * Update the specified Cidade in storage.
     *
     * @param  int              $id
     * @param UpdateCidadeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCidadeRequest $request)
    {
        $cidade = $this->cidadeRepository->find($id);

        if (empty($cidade)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cidades.singular')]));

            return redirect(route('cidades.index'));
        }

        $cidade = $this->cidadeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cidades.singular')]));

        return redirect(route('cidades.index'));
    }

    /**
     * Remove the specified Cidade from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cidade = $this->cidadeRepository->find($id);

        if (empty($cidade)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cidades.singular')]));

            return redirect(route('cidades.index'));
        }

        $this->cidadeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cidades.singular')]));

        return redirect(route('cidades.index'));
    }
}
