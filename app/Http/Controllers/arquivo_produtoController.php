<?php

namespace App\Http\Controllers;

use App\DataTables\arquivo_produtoDataTable;
use App\Http\Requests;
use App\Http\Requests\Createarquivo_produtoRequest;
use App\Http\Requests\Updatearquivo_produtoRequest;
use App\Repositories\arquivo_produtoRepository;
use App\Repositories\tipo_arquivoRepository;
use App\Repositories\produtoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class arquivo_produtoController extends AppBaseController
{
    /** @var arquivo_produtoRepository $arquivoProdutoRepository*/
    private $arquivoProdutoRepository;
    /** @var tipo_arquivoRepository $tipoArquivoRepository*/
    private $tipoArquivoRepository;
    /** @var produtoRepository $produtoRepository*/
    private $produtoRepository;
    /**
     * @param arquivo_produtoRepository $arquivoProdutoRepo
     * @param tipo_arquivoRepository $tipoArquivoRepo
     * @param produtoRepository $produtoRepo
     */
    public function __construct(arquivo_produtoRepository $arquivoProdutoRepo, tipo_arquivoRepository $tipoArquivoRepo, produtoRepository $produtoRepo)
    {
        $this->arquivoProdutoRepository = $arquivoProdutoRepo;
        $this->tipoArquivoRepository = $tipoArquivoRepo;
        $this->produtoRepository = $produtoRepo;
    }

    /**
     * Display a listing of the arquivo_produto.
     *
     * @param arquivo_produtoDataTable $arquivoProdutoDataTable
     *
     * @return Response
     */
    public function index(arquivo_produtoDataTable $arquivoProdutoDataTable)
    {
        return $arquivoProdutoDataTable->render('arquivo_produtos.index');
    }

    /**
     * Show the form for creating a new arquivo_produto.
     *
     * @return Response
     */
    public function create()
    {
        return view('arquivo_produtos.create')->with([
            'produtos' => $this->produtoRepository->all()->pluck('nome', 'id'),
            'tipoArquivos' => $this->tipoArquivoRepository->all()->pluck('desc_tipo_arquivo', 'id')
        ]);
        
    }

    /**
     * Store a newly created arquivo_produto in storage.
     *
     * @param Createarquivo_produtoRequest $request
     *
     * @return Response
     */
    public function store(Createarquivo_produtoRequest $request)
    {
        $input = $request->all();

        // Verifica se o arquivo foi enviado        
        if ($request->hasFile('link')) {
            $file_upload = $request->file('link');
            $name = time() . '_' . $file_upload->getClientOriginalName();
            $filePath = $file_upload->storeAs('arquivo_produto', $name, 'public');
            $input['link'] = $filePath;
        }


        $arquivoProduto = $this->arquivoProdutoRepository->create($input);
        $arquivoProduto->save();
        
        Flash::success(__('messages.saved', ['model' => __('models/arquivoProdutos.singular')]));

        return redirect(route('arquivoProdutos.index'));
    }

    /**
     * Display the specified arquivo_produto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $arquivoProduto = $this->arquivoProdutoRepository->find($id)->load('tipoArquivos');

        if (empty($arquivoProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivoProdutos.singular')]));

            return redirect(route('arquivoProdutos.index'));
        }

        return view('arquivo_produtos.show')->with('arquivoProduto', $arquivoProduto)->with([
            'produtos' => $this->produtoRepository->all()->pluck('referencia', 'id'),
            'tipoArquivos' => $this->tipoArquivoRepository->all()->pluck('desc_tipo_arquivo', 'id')
        ]);
    }

    /**
     * Show the form for editing the specified arquivo_produto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $arquivoProduto = $this->arquivoProdutoRepository->find($id);

        if (empty($arquivoProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivoProdutos.singular')]));

            return redirect(route('arquivoProdutos.index'));
        }

        return view('arquivo_produtos.edit')->with('arquivoProduto', $arquivoProduto)->with([
            'produtos' => $this->produtoRepository->all()->pluck('referencia', 'id'),
            'tipoArquivos' => $this->tipoArquivoRepository->all()->pluck('desc_tipo_arquivo', 'id')
        ]);
    }

    /**
     * Update the specified arquivo_produto in storage.
     *
     * @param int $id
     * @param Updatearquivo_produtoRequest $request
     *
     * @return Response
     */
    public function update($id, Updatearquivo_produtoRequest $request)
    {
        $arquivoProduto = $this->arquivoProdutoRepository->find($id);

        if (empty($arquivoProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivoProdutos.singular')]));

            return redirect(route('arquivoProdutos.index'));
        }

        $arquivoProduto = $this->arquivoProdutoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/arquivoProdutos.singular')]));

        return redirect(route('arquivoProdutos.index'));
    }

    /**
     * Remove the specified arquivo_produto from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $arquivoProduto = $this->arquivoProdutoRepository->find($id);

        if (empty($arquivoProduto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivoProdutos.singular')]));

            return redirect(route('arquivoProdutos.index'));
        }

        $this->arquivoProdutoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/arquivoProdutos.singular')]));

        return redirect(route('arquivoProdutos.index'));
    }
}
