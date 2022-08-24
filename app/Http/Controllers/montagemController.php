<?php

namespace App\Http\Controllers;

use App\DataTables\montagemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemontagemRequest;
use App\Http\Requests\UpdatemontagemRequest;
use App\Models\produto;
use App\Repositories\montadoraRepository;
use App\Repositories\montagemRepository;
use App\Repositories\produtoRepository;
use App\Repositories\status_montagemRepository;
use Flash;
use Helper;


use App\Http\Controllers\AppBaseController;
use Response;

class montagemController extends AppBaseController
{
    /** @var  montagemRepository */
    private $montagemRepository;
    /** @var  produtoRepository */
    private $produtoRepository;
    /** @var  status_montagemRepository */
    private $statusMontagemRepository;
    /** @var  montadoraRepository */
    private $montadoraRepository;


    public function __construct(montadoraRepository $montadoraRepo,status_montagemRepository $statusMontagemRepo,produtoRepository $produtoRepo,montagemRepository $montagemRepo)
    {
        $this->montagemRepository = $montagemRepo;
        $this->produtoRepository = $produtoRepo;
        $this->statusMontagemRepository = $statusMontagemRepo;
        $this->montadoraRepository = $montadoraRepo;

    }

    /**
     * Display a listing of the montagem.
     *
     * @param montagemDataTable $montagemDataTable
     * @return Response
     */
    public function index(montagemDataTable $montagemDataTable)
    {
        return $montagemDataTable->render('montagems.index');
    }

    /**
     * Show the form for creating a new montagem.
     *
     * @return Response
     */
    public function create()
    {
        return view('montagems.create')
            ->with('montadora',$this->montadoraRepository->all()->pluck('nome','id'))
            ->with('status_montagem',$this->statusMontagemRepository->all()->pluck('nome','id'))
            ->with('produtos',$this->produtoRepository->all()->pluck('nome','id'));
    }

    /**
     * Store a newly created montagem in storage.
     *
     * @param CreatemontagemRequest $request
     *
     * @return Response
     */
    public function store(CreatemontagemRequest $request)
    {
        $input = $request->all();
        $dados = array();
        $input['data_envio'] = date( "Y-m-d", strtotime(str_replace('/', '-', $input['data_envio']) ));
        $input['data_retorno'] = (empty($input['data_retorno']) ?  null : date( "Y-m-d", strtotime(str_replace('/', '-', $input['data_retorno']) )));

        $montagem = $this->montagemRepository->create($input);
        $montagem->save();

        $produto_id = $request->get('_produto_id');
        $quantidade = $request->get('_quantidade');

        foreach ($produto_id as $key => $item){
            $dados[]= ['montagem_id'=>$montagem->id, 'produto_id'=>$produto_id[$key],'quantidade'=>$quantidade[$key]];
        }

        $montagem->produto()->attach($dados);


        //foreach ($produto_id )

             //
        //$montagem->produto_has()->attach(['produto_id'=>$produto_id,'quantidade'=>$quantidade]);


        Flash::success(__('messages.saved', ['model' => __('models/montagems.singular')]));

        return redirect(route('montagems.index'));
    }

    /**
     * Display the specified montagem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $montagem = $this->montagemRepository->find($id);

       if (empty($montagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montagems.singular')]));

            return redirect(route('montagems.index'));
        }

        return view('montagems.show')
            ->with('montagem', $montagem)
            ->with('montadora',$montagem->montadoras()->get()[0])
            ->with('status_montagem',$montagem->statusMontagems()->get()[0])
            ->with('produtos',$montagem->produto());
    }

    /**
     * Show the form for editing the specified montagem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $montagem = $this->montagemRepository->find($id);
        $montagem['update'] = true;

        if (empty($montagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montagems.singular')]));

            return redirect(route('montagems.index'));
        }


        return view('montagems.edit')
            ->with('montagem', $montagem)
            ->with('montadora',$this->montadoraRepository->all()->pluck('nome','id'))
            ->with('status_montagem',$this->statusMontagemRepository->all()->pluck('nome','id'))
            ->with('produtos',$this->produtoRepository->all()->pluck('nome','id'));
    }

    /**
     * Update the specified montagem in storage.
     *
     * @param  int              $id
     * @param UpdatemontagemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemontagemRequest $request)
    {
       $montagem = $this->montagemRepository->find($id);
       $data =  $request->all();
       if(!empty($data['data_envio'] ))
            $data['data_envio'] = Helper::inDate($data['data_envio']);
       if(!empty($data['data_retorno'] ))
            $data['data_retorno'] = Helper::inDate($data['data_retorno']);

        if (empty($montagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montagems.singular')]));

            return redirect(route('montagems.index'));
        }

        $montagem = $this->montagemRepository->update($data, $id);

        Flash::success(__('messages.updated', ['model' => __('models/montagems.singular')]));

        return redirect(route('montagems.index'));
    }

    /**
     * Remove the specified montagem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $montagem = $this->montagemRepository->find($id);

        if (empty($montagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/montagems.singular')]));

            return redirect(route('montagems.index'));
        }

        $this->montagemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/montagems.singular')]));

        return redirect(route('montagems.index'));
    }
}
