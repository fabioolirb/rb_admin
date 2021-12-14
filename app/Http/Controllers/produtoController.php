<?php

namespace App\Http\Controllers;

use App\DataTables\produtoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateprodutoRequest;
use App\Http\Requests\UpdateprodutoRequest;
use App\Repositories\categoriaRepository;
use App\Repositories\produtoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class produtoController extends AppBaseController
{
    /** @var  produtoRepository */
    private $produtoRepository;
    /** @var  categoriaRepository */
    private $categoriaRepository;

    public function __construct(produtoRepository $produtoRepo, categoriaRepository $categoriaRepo )
    {
        $this->produtoRepository = $produtoRepo;
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Display a listing of the produto.
     *
     * @param produtoDataTable $produtoDataTable
     * @return Response
     */
    public function index(produtoDataTable $produtoDataTable)
    {
       return $produtoDataTable->render('produtos.index');
    }

    /**
     * Show the form for creating a new produto.
     *
     * @return Response
     */
    public function create()
    {
        return view('produtos.create')->with('categorias',$this->categoriaRepository->all()->pluck('nome','id'));
    }

    /**
     * Store a newly created produto in storage.
     *
     * @param CreateprodutoRequest $request
     *
     * @return Response
     */
    public function store(CreateprodutoRequest $request)
    {
        $input = $request->all();

        $produto = $this->produtoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }

    /**
     * Display the specified produto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/produtos.singular')]));

            return redirect(route('produtos.index'));
        }

        return view('produtos.show')->with(['produto'=>$produto ,'categorias'=>$this->categoriaRepository->all()->pluck('nome','id')]);
    }

    /**
     * Show the form for editing the specified produto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/produtos.singular')]));


            return redirect(route('produtos.index'));
        }


        return view('produtos.edit')->with(['produto'=>$produto ,'categorias'=>$this->categoriaRepository->all()->pluck('nome','id')]);
    }

    /**
     * Update the specified produto in storage.
     *
     * @param  int              $id
     * @param UpdateprodutoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprodutoRequest $request)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/produtos.singular')]));

            return redirect(route('produtos.index'));
        }

        $produto = $this->produtoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }

    /**
     * Remove the specified produto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produto = $this->produtoRepository->find($id);

        if (empty($produto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/produtos.singular')]));

            return redirect(route('produtos.index'));
        }

        $this->produtoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/produtos.singular')]));

        return redirect(route('produtos.index'));
    }
}
