<?php

namespace App\Http\Controllers;

use App\DataTables\imagem_produtoDataTable;
use App\Http\Requests;
use App\Http\Requests\Createimagem_produtoRequest;
use App\Http\Requests\Updateimagem_produtoRequest;
use App\Models\cor;
use App\Models\imagem_produto;
use App\Repositories\imagem_produtoRepository;
use App\Repositories\corRepository;
use App\Repositories\produtoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class imagem_produtoController extends AppBaseController
{
    /** @var  imagem_produtoRepository */
    private $imagemProdutoRepository;
    /** @var  imagem_produto */
    private $imagemProduto;
    /** @var  corRepository */
    private $corRepository;
    /** @var  produtoRepository */
    private $produtosRepository;

    public function __construct(imagem_produto $imagemProduto, imagem_produtoRepository $imagemProdutoRepo, corRepository $corRepo,produtoRepository $produtoRepo )
    {
        $this->imagemProdutoRepository = $imagemProdutoRepo;
        $this->corRepository = $corRepo;
        $this->produtoRepository = $produtoRepo;
        $this->imagemProduto = $imagemProduto;
    }

    /**
     * Display a listing of the imagem_produto.
     *
     * @param imagem_produtoDataTable $imagemProdutoDataTable
     * @return Response
     */
    public function index(imagem_produtoDataTable $imagemProdutoDataTable, imagem_produto $img , cor $cor)
    {

        return $imagemProdutoDataTable->render('imagem_produtos.index');
    }

    /**
     * Show the form for creating a new imagem_produto.
     *
     * @return Response
     */
    public function create()
    {
        return view('imagem_produtos.create')->with([

            'produtos'=>$this->produtoRepository->all()->pluck('nome', 'id'),
            'cors' =>$this->corRepository->all()->pluck('referencia', 'id')
        ]);

    }

    /**
     * Store a newly created imagem_produto in storage.
     *
     * @param Createimagem_produtoRequest $request
     *
     * @return Response
     */
    public function store(Createimagem_produtoRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('link')) {
            $file_upload = $request->file('link');
            $name = time() . '_' . $file_upload->getClientOriginalName();
            $filePath = $file_upload->storeAs('imagem_produto', $name, 'public');
            $input['link'] = $filePath;
        }

        $imagemProduto = $this->imagemProduto->create($input);
        $imagemProduto->save();
        $cor_data = $request->get('cor_data');

        //
        $imagemProduto->cor()->attach($cor_data);

        Flash::success(__('messages.saved', ['model' => __('models/imagemProdutos.singular')]));

        return redirect(route('imagemProdutos.index'));
    }

    /**
     * Display the specified imagem_produto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       // $imagemProduto = $this->imagemProdutoRepository->find($id);
        $imagemProduto = $this->imagemProdutoRepository->find($id)->load('cor');

        if (empty($imagemProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/imagemProdutos.singular')]));

            return redirect(route('imagemProdutos.index'));
        }

        return view('imagem_produtos.show')->with('imagemProduto', $imagemProduto);
    }

    /**
     * Show the form for editing the specified imagem_produto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imagemProduto = $this->imagemProdutoRepository->find($id)->load('cor');

        if (empty($imagemProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/imagemProdutos.singular')]));

            return redirect(route('imagemProdutos.index'));
        }

        return view('imagem_produtos.edit')
            ->with('imagemProduto',$imagemProduto)
            ->with('produtos',$this->produtoRepository->all()->pluck('nome', 'id'))
            ->with('cors' ,$this->corRepository->all()->pluck('referencia', 'id'));
    }

    /**
     * Update the specified imagem_produto in storage.
     *
     * @param  int              $id
     * @param Updateimagem_produtoRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimagem_produtoRequest $request)
    {

        $imagemProduto = $this->imagemProdutoRepository->find($id)->load('cor');
        $input = $request->all();

        if ($request->hasFile('link')) {
            $file_upload = $request->file('link');
            $name = time() . '_' . $file_upload->getClientOriginalName();
            $filePath = $file_upload->storeAs('imagem_produto', $name, 'public');
            $input['link'] = $filePath;
        }

        if (empty($imagemProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/imagemProdutos.singular')]));
            return redirect(route('imagemProdutos.index'));
        }

        $imagemProduto = $this->imagemProdutoRepository->update($input, $id);
        $cor_data = $request->get('cor_data');
        $imagemProduto->imagem_has_cor_delete($id);
        $imagemProduto->cor()->attach($cor_data);

        Flash::success(__('messages.updated', ['model' => __('models/imagemProdutos.singular')]));
        return redirect(route('imagemProdutos.index'));
    }

    /**
     * Remove the specified imagem_produto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imagemProduto = $this->imagemProdutoRepository->find($id);

        if (empty($imagemProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/imagemProdutos.singular')]));

            return redirect(route('imagemProdutos.index'));
        }

        $this->imagemProdutoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/imagemProdutos.singular')]));

        return redirect(route('imagemProdutos.index'));
    }
}
