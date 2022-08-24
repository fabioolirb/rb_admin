<?php

namespace App\Http\Controllers;

use App\DataTables\estoqueDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateestoqueRequest;
use App\Http\Requests\UpdateestoqueRequest;
use App\Models\produto;
use App\Models\ordem;
use App\Models\ordem_producaos;
use App\Repositories\estoqueRepository;
use App\Repositories\ordemRepository;
use App\Repositories\produtoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;

class estoqueController extends AppBaseController
{
    /** @var  estoqueRepository */
    private $estoqueRepository;
    /** @var  produtoRepository */
    private $produtoRepository;
    /** @var  ordemRepository */
    private $ordemRepository;

    public function __construct(estoqueRepository $estoqueRepo ,ordemRepository $ordermRepo,produtoRepository $produtoRepo)
    {
        $this->estoqueRepository = $estoqueRepo;
        $this->produtoRepository = $produtoRepo;
        $this->ordemRepository = $ordermRepo;


    }

    /**
     * Display a listing of the estoque.
     *
     * @param estoqueDataTable $estoqueDataTable
     * @return Response
     */
    public function index(estoqueDataTable $estoqueDataTable)
    {
        return $estoqueDataTable->render('estoques.index');
    }

    /**
     * Show the form for creating a new estoque.
     *
     * @return Response
     */
    public function create(CreateestoqueRequest $request)
    {

        return view('estoques.create')->with([
            'ordem'=>$this->ordemRepository->all()->pluck('id','id'),
            'produto' =>$this->produtoRepository->all()->pluck('nome', 'id')
        ]);
    }

    /**
     * Store a newly created estoque in storage.
     *
     * @param CreateestoqueRequest $request
     *
     * @return Response
     */
    public function store(CreateestoqueRequest $request)
    {
        $input = $request->all();

        $input['data_producao'] = Carbon::createFromFormat('d/m/Y', $input['data_producao'])->format('Y-m-d');

        $estoque = $this->estoqueRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/estoques.singular')]));

        return redirect(route('estoques.create'));
    }

    /**
     * Display the specified estoque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error(__('messages.not_found', ['model' => __('models/estoques.singular')]));

            return redirect(route('estoques.index'));
        }

        return view('estoques.show')->with('estoque', $estoque);
    }

    /**
     * Show the form for editing the specified estoque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, ordem $ordem)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error(__('messages.not_found', ['model' => __('models/estoques.singular')]));

            return redirect(route('estoques.index'));
        }

        return view('estoques.edit')->with('estoque', $estoque)->with([
            'ordem'=>$this->ordemRepository->all()->pluck('id','id'),
            'produto' => $ordem->getproduct($id)]);
    }

    /**
     * Update the specified estoque in storage.
     *
     * @param  int              $id
     * @param UpdateestoqueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateestoqueRequest $request)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error(__('messages.not_found', ['model' => __('models/estoques.singular')]));

            return redirect(route('estoques.index'));
        }

        $estoque = $this->estoqueRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/estoques.singular')]));

        return redirect(route('estoques.index'));
    }

    /**
     * Remove the specified estoque from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error(__('messages.not_found', ['model' => __('models/estoques.singular')]));

            return redirect(route('estoques.index'));
        }

        $this->estoqueRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/estoques.singular')]));

        return redirect(route('estoques.index'));
    }

    public function getproduct(Request $request, Ordem $ordem ){

        if(!empty($request->id)){
           $produtos = $ordem->getproduct($request->id);

            return response()->json([
                'produtos' => $produtos
            ]);
        }
    }
}
