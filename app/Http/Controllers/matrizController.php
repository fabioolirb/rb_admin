<?php

namespace App\Http\Controllers;

use App\DataTables\matrizDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatematrizRequest;
use App\Http\Requests\UpdatematrizRequest;
use App\Models\imagem_produto;
use App\Repositories\imagem_produtoRepository;
use App\Repositories\matrizRepository;
use App\Repositories\produtoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class matrizController extends AppBaseController
{
    /** @var matrizRepository $matrizRepository*/
    private $matrizRepository;
    /** @var  produtoRepository */
    private $produtoRepository;

    public function __construct(matrizRepository $matrizRepo ,produtoRepository $produtoRepo)
    {
        $this->matrizRepository = $matrizRepo;
        $this->produtoRepository = $produtoRepo;
    }

    /**
     * Display a listing of the matriz.
     *
     * @param matrizDataTable $matrizDataTable
     *
     * @return Response
     */
    public function index(matrizDataTable $matrizDataTable)
    {


        return $matrizDataTable->render('matrizs.index');
    }

    /**
     * Show the form for creating a new matriz.
     *
     * @return Response
     */
    public function create()
    {

        return view('matrizs.create')->with(['produto'=>$this->produtoRepository->all()->pluck('nome', 'id')]);

    }

    /**
     * Store a newly created matriz in storage.
     *
     * @param CreatematrizRequest $request
     *
     * @return Response
     */
    public function store(CreatematrizRequest $request)
    {
        $input = $request->all();

        $matriz = $this->matrizRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/matrizs.singular')]));

        return redirect(route('matrizs.index'));
    }

    /**
     * Display the specified matriz.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $matriz = $this->matrizRepository->find($id)->load('produtos');

        if (empty($matriz)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizs.singular')]));

            return redirect(route('matrizs.index'));
        }

        return view('matrizs.show')->with('matriz', $matriz);
    }

    /**
     * Show the form for editing the specified matriz.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizs.singular')]));

            return redirect(route('matrizs.index'));
        }

        return view('matrizs.edit')->with('matriz', $matriz);
    }

    /**
     * Update the specified matriz in storage.
     *
     * @param int $id
     * @param UpdatematrizRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatematrizRequest $request)
    {
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizs.singular')]));

            return redirect(route('matrizs.index'));
        }

        $matriz = $this->matrizRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/matrizs.singular')]));

        return redirect(route('matrizs.index'));
    }

    /**
     * Remove the specified matriz from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $matriz = $this->matrizRepository->find($id);

        if (empty($matriz)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizs.singular')]));

            return redirect(route('matrizs.index'));
        }

        $this->matrizRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/matrizs.singular')]));

        return redirect(route('matrizs.index'));
    }
}
