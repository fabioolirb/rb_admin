<?php

namespace App\Http\Controllers;
//use http\Env\Request;
use App\Models\produto;
use App\Repositories\ordemRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\DataTables\producaoDataTable;
//use App\Http\Requests;
use App\Http\Requests\CreateproducaoRequest;
use App\Http\Requests\UpdateproducaoRequest;
use App\Repositories\corRepository;
use App\Repositories\imagem_produtoRepository;
use App\Repositories\maquinaRepository;
use App\Repositories\operadorRepository;
use App\Repositories\producaoRepository;
use App\Repositories\turnoRepository;
use App\Repositories\categoriaRepository;
use App\Models\imagem_produto;
use App\Models\vwproducao;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;
use Response;

class producaoController extends AppBaseController
{
    /** @var  producaoRepository */
    /**  @var turnoRepository */
    /**  @var imagem_produtoRepository */
    /**  @var maquinaRepository */
    /** @var operadorRepository */


    private $producaoRepository;
    private $turnoRepository ;
    private $imagem_produtoRepository;
    private $maquinaRepository;
    private $operadorRepository;
    private $corRepository;
    private $categoriaRepository;
    private $ordemRepository;


    public function __construct(ordemRepository $ordermRepo ,producaoRepository $producaoRepo , turnoRepository $turnoRepo , imagem_produtoRepository $imagem_produtoRepo, maquinaRepository $maquinaRepo, operadorRepository $operadorRepo,  corRepository $corRepo, categoriaRepository $categoriaRepo)
    {
        $this->producaoRepository = $producaoRepo;
        $this->turnoRepository = $turnoRepo ;
        $this->imagem_produtoRepository = $imagem_produtoRepo;
        $this->maquinaRepository = $maquinaRepo;
        $this->operadorRepository = $operadorRepo;
        $this->corRepository = $corRepo;
        $this->categoriaRepository = $categoriaRepo;
        $this->ordemRepository = $ordermRepo;

    }


    /**
     * Display a listing of the producao.
     *
     * @param producaoDataTable $producaoDataTable
     * @return Response
     */
    public function index(producaoDataTable $producaoDataTable)
    {
        return $producaoDataTable->render('producaos.index');
    }

    /**
     * Show the form for creating a new producao.
     *
     * @return Response
     */
    public function create()
    {

        return view('producaos.create')->with([
            'turno'=>$this->turnoRepository->all()->pluck('nome', 'id'),
            'imagem_produto' =>$this->imagem_produtoRepository->all()->pluck('nome', 'id'),
            'maquina' =>$this->maquinaRepository->all()->pluck('nome', 'id'),
            'operador' =>$this->operadorRepository->all()->pluck('nome', 'id'),
            'cors' => $this->corRepository->all()->pluck('referencia', 'id'),
            'categorias'=>$this->categoriaRepository->all()->pluck('nome','id'),

        ]);
    }

    /**
     * Store a newly created producao in storage.
     *
     * @param CreateproducaoRequest $request
     *
     * @return Response
     */
    public function store(CreateproducaoRequest $request)
    {
        $input = $request->all();
        $request_order = array();

        $request_order['data_ini'] = $input['_data_ini'][0];
        $request_order['maquina_id'] = $input['_maquina_id'][0];
        $request_order['data_end'] = $input['_data_fim'][0];

        $imagem_select = $input['_imagem_id'];

        $order =  $this->ordemRepository->create($request_order);
        $order->save();
        $request_order = array();

        foreach ($imagem_select as $key => $imagem){

            $request_order['imagem_id'] = $imagem;
            $request_order['data'] = $input['_data_ini'][$key];
            $request_order['operador_id'] = $input['_operador_id'][$key];
            $request_order['turno_id'] = $input['_turno_id'][$key];
            $request_order['qtd_diario'] = $input['_qtd_diario'][$key];

            $producao = $this->producaoRepository->create($request_order);
            $producao->save();
            $request_order = array();
            $rs_producao['producao_id'][] =$producao->id ;

        }

        $order->ordems()->attach($rs_producao['producao_id']);


        Flash::success(__('messages.saved', ['model' => __('models/producaos.singular')]));

        return redirect(route('producaos.index'));
    }

    /**
     * Display the specified producao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id ,vwproducao $vwproducao, produto $rs_produtos)
    {
        $producao = $vwproducao->order_id($id);


        foreach ( $producao as $key => $produto){
            $ordem = $produto;
            $dadosProduto = $rs_produtos->vw_produtos($produto->produto_id);
            $producao[$key]->info = $dadosProduto;
        }

        if (empty($produto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/producaos.singular')]));

            return redirect(route('producaos.index'));
        }

        return view('producaos.show')->with(['producao'=>$producao,'ordem'=>$ordem]);

    }

    /**
     * Show the form for editing the specified producao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $producao = $this->producaoRepository->find($id);

        if (empty($producao)) {
            Flash::error(__('messages.not_found', ['model' => __('models/producaos.singular')]));

            return redirect(route('producaos.index'));
        }

        return view('producaos.edit')->with(['producao'=>$producao,
            'turno'=>$this->turnoRepository->all()->pluck('nome', 'id'),
            'imagem_produto' =>$this->imagem_produtoRepository->all()->pluck('nome', 'id'),
            'maquina' =>$this->maquinaRepository->all()->pluck('nome', 'id'),
            'operador' =>$this->operadorRepository->all()->pluck('nome', 'id'),
            'cors' => $this->corRepository->all()->pluck('referencia', 'id'),
            'categorias'=>$this->categoriaRepository->all()->pluck('nome','id')
        ]);
    }

    /**
     * Update the specified producao in storage.
     *
     * @param  int              $id
     * @param UpdateproducaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproducaoRequest $request)
    {
        $producao = $this->producaoRepository->find($id);

        if (empty($producao)) {
            Flash::error(__('messages.not_found', ['model' => __('models/producaos.singular')]));

            return redirect(route('producaos.index'));
        }

        $producao = $this->producaoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/producaos.singular')]));

        return redirect(route('producaos.index'));
    }

    /**
     * Remove the specified producao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $producao = $this->producaoRepository->find($id);

        if (empty($producao)) {
            Flash::error(__('messages.not_found', ['model' => __('models/producaos.singular')]));

            return redirect(route('producaos.index'));
        }

        $this->producaoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/producaos.singular')]));

        return redirect(route('producaos.index'));
    }

    /**
     * Retorna em ajax para validar as corres na ordem de produção
     *
     */

    public function validaCor(Request $request,imagem_produto $imagem_produto, produto $rs_produtos){

        $id_cor = $request['cor_data'];
        $categoria_id = $request['categoria_id'];
        $busca = $request['busca'];

        if(!empty($id_cor)||!empty($categoria_id)||empty($busca)){

            $produtos_cores = $imagem_produto->produto_cor($id_cor,$categoria_id,$busca);

            foreach ( $produtos_cores as $key => $produto){
                $produtos_cores[$key]->info = $rs_produtos->vw_produtos($produto->produto_id);

            }

            $userData['data'] = $produtos_cores;

            return Response::json($userData);

        }


    }

    public function teste(Request $request,imagem_produto $imagem_produto){

        $id_cor = $request['data_cor'];
        $id_cor =[8,9,6,5];

        if(!empty($id_cor)){

            $produtos_cores = $imagem_produto->produto_cor($id_cor)->toArray();

            $userData['data'] = $produtos_cores;
            $imagem_cor =array();
            foreach ($produtos_cores as $key=>$produtos_cor){

                $imagem_cor[$produtos_cor->imagem_id][$produtos_cor->cor_id]=$produtos_cor;
            }

            echo json_encode($userData);

        }

    }

}
