<?php

namespace App\Http\Controllers;

use App\DataTables\ia_producaoDataTable;
use App\Http\Requests;
use App\Http\Requests\Createia_producaoRequest;
use App\Http\Requests\Updateia_producaoRequest;
use App\Models\vwordemcor;
use App\Models\imagem_produto;
use App\Repositories\ia_producaoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ia_producaoController extends AppBaseController
{
    /** @var ia_producaoRepository $iaProducaoRepository*/
    private $iaProducaoRepository;

    public function __construct(ia_producaoRepository $iaProducaoRepo)
    {
        $this->iaProducaoRepository = $iaProducaoRepo;
    }

    /**
     * Display a listing of the ia_producao.
     *
     * @param ia_producaoDataTable $iaProducaoDataTable
     *
     * @return Response
     */
    public function index(ia_producaoDataTable $iaProducaoDataTable)
    {
        return $iaProducaoDataTable->render('ia_producaos.index');
    }

    /**
     * Show the form for creating a new ia_producao.
     *
     * @return Response
     */
    public function create()
    {
        return view('ia_producaos.create');
    }

    /**
     * Store a newly created ia_producao in storage.
     *
     * @param Createia_producaoRequest $request
     *
     * @return Response
     */
    public function store(Createia_producaoRequest $request)
    {
        $input = $request->all();

        $iaProducao = $this->iaProducaoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/iaProducaos.singular')]));

        return redirect(route('iaProducaos.index'));
    }

    /**
     * Display the specified ia_producao.
     *
     * @param int $id
     *
     * @return Response
     */
   // public function show($id)
  //  {
   //     $iaProducao = $this->iaProducaoRepository->find($id);

  //      if (empty($iaProducao)) {
  //          Flash::error(__('messages.not_found', ['model' => __('models/iaProducaos.singular')]));

  //          return redirect(route('iaProducaos.index'));
  //      }

  //      return view('ia_producaos.show')->with('iaProducao', $iaProducao);
  //  }

    /**
     * Show the form for editing the specified ia_producao.
     *
     * @param int $id
     *
     * @return Response
     */
    //public function edit($id)
    //{
   //     $iaProducao = $this->iaProducaoRepository->find($id);

   //     if (empty($iaProducao)) {
   //         Flash::error(__('messages.not_found', ['model' => __('models/iaProducaos.singular')]));

   //         return redirect(route('iaProducaos.index'));
    //    }

    //    return view('ia_producaos.edit')->with('iaProducao', $iaProducao);
  //  }

    public function show($id , imagem_produto $imagem_produto, vwordemcor $vwordemcor ){

        $in_cor_maqina_array = array();
        $in_order = array();
        $rs_maquina = array();

        $core_maquina = $vwordemcor->maquina(0);
        //dd($core_maquina->toArray());


        if (empty($core_maquina)) {
            Flash::error(__('messages.not_found', ['model' => __('models/iaProducaos.singular')]));

            return redirect(route('iaProducaos.index'));
        }

        foreach ($core_maquina as $value_cor_maquina){

            $rs_maquina[$value_cor_maquina['maquina_id']]['maquina_nome']= $value_cor_maquina->maquina_nome;
            $rs_maquina[$value_cor_maquina['maquina_id']]['produtos'][$value_cor_maquina->imagem_produtos_id]= $value_cor_maquina->nome. " ( $value_cor_maquina->id_ordem )";
            $rs_maquina[$value_cor_maquina['maquina_id']]['produtos_cor'][$value_cor_maquina->imagem_produtos_id]['cores'][$value_cor_maquina->id_cor]= $value_cor_maquina->cor;

            $in_cor_maqina_array[$value_cor_maquina['maquina_id']][$value_cor_maquina->id_cor] = [
                'id_cor' => $value_cor_maquina->id_cor,
                'cor' => $value_cor_maquina->cor,
                'referencia' => $value_cor_maquina->referencia
            ];
            ksort( $in_cor_maqina_array[$value_cor_maquina['maquina_id']]);
        }

        $ordem = $vwordemcor->ordem($id);

        foreach ($ordem as $value_ordem){

            $rs_order_cor[$value_ordem['imagem_produtos_id']][$value_ordem->id_cor]= ['cor'=>$value_ordem->cor,'referencia'=>$value_ordem->referencia];
            $rs_order_imagem_id[$value_ordem['imagem_produtos_id']] = $value_ordem->toArray();

            $in_order[$value_ordem['imagem_produtos_id']][$value_ordem['id_cor']] = $value_ordem['id_cor'];
            // ksort($rs_order_imagem_id );
        }
//dd($in_cor_maqina_array);

        foreach ($in_cor_maqina_array as $key_maquina => $value_in_cor_maquina) {
            foreach ($in_order as $key_ordem => $value_order ){
                if(!empty($this->verificarProducao($value_order,$value_in_cor_maquina))){
                    $rs_order_imagem_id[$key_ordem]['producao_in'][$key_maquina] = true ;
                }elseif (empty($rs_order_imagem_id[$key_ordem]['producao_in'])) {
                    $rs_order_imagem_id[$key_ordem]['producao_in'] = false;
                }
            }
        }


        ksort($in_cor_maqina_array);
        ksort($rs_order_imagem_id);
        ksort($rs_order_cor);
        ksort($rs_maquina);


        $data['maquinas']= $in_cor_maqina_array;
        $data['order']= $rs_order_imagem_id;
        $data['cor_imagem']= $rs_order_cor;
        $data['rs_maquina'] = $rs_maquina;


        return view('ia_producaos.show')->with($data);




        // return Response::json($data );

//        $id_cor = $request['data_cor'];
        //      $id_cor =[8,9,6,5];

        //    if(!empty($id_cor)){

        //      $produtos_cores = $imagem_produto->produto_cor($id_cor)->toArray();

        //    $userData['data'] = $produtos_cores;
        //   $imagem_cor =array();
        //   foreach ($produtos_cores as $key=>$produtos_cor){

        //       $imagem_cor[$produtos_cor->imagem_id][$produtos_cor->cor_id]=$produtos_cor;
        //   }

        //  echo json_encode($userData);

        // }

    }

    function verificarProducao($peca, $coresDisponiveis) {
        foreach ($peca as $cor) {

            if (!array_key_exists($cor, $coresDisponiveis)) {
                return false;
            }
        }
        return true;
    }





    /**
     * Update the specified ia_producao in storage.
     *
     * @param int $id
     * @param Updateia_producaoRequest $request
     *
     * @return Response
     */
    public function update($id, Updateia_producaoRequest $request)
    {
        $iaProducao = $this->iaProducaoRepository->find($id);

        if (empty($iaProducao)) {
            Flash::error(__('messages.not_found', ['model' => __('models/iaProducaos.singular')]));

            return redirect(route('iaProducaos.index'));
        }

        $iaProducao = $this->iaProducaoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/iaProducaos.singular')]));

        return redirect(route('iaProducaos.index'));
    }

    /**
     * Remove the specified ia_producao from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iaProducao = $this->iaProducaoRepository->find($id);

        if (empty($iaProducao)) {
            Flash::error(__('messages.not_found', ['model' => __('models/iaProducaos.singular')]));

            return redirect(route('iaProducaos.index'));
        }

        $this->iaProducaoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/iaProducaos.singular')]));

        return redirect(route('iaProducaos.index'));
    }
}
