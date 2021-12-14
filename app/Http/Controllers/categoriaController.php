<?php

namespace App\Http\Controllers;

use App\DataTables\categoriaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecategoriaRequest;
use App\Http\Requests\UpdatecategoriaRequest;
use App\Repositories\categoriaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class categoriaController extends AppBaseController
{
    /** @var  categoriaRepository */
    private $categoriaRepository;

    public function __construct(categoriaRepository $categoriaRepo)
    {
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Display a listing of the categoria.
     *
     * @param categoriaDataTable $categoriaDataTable
     * @return Response
     */
    public function index(categoriaDataTable $categoriaDataTable)
    {
        return $categoriaDataTable->render('categorias.index');
    }

    /**
     * Show the form for creating a new categoria.
     *
     * @return Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created categoria in storage.
     *
     * @param CreatecategoriaRequest $request
     *
     * @return Response
     */
    public function store(CreatecategoriaRequest $request)
    {
        $input = $request->all();

        $categoria = $this->categoriaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/categorias.singular')]));

        return redirect(route('categorias.index'));
    }

    /**
     * Display the specified categoria.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categorias.singular')]));

            return redirect(route('categorias.index'));
        }

        return view('categorias.show')->with('categoria', $categoria);
    }

    /**
     * Show the form for editing the specified categoria.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categorias.singular')]));

            return redirect(route('categorias.index'));
        }

        return view('categorias.edit')->with('categoria', $categoria);
    }

    /**
     * Update the specified categoria in storage.
     *
     * @param  int              $id
     * @param UpdatecategoriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategoriaRequest $request)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categorias.singular')]));

            return redirect(route('categorias.index'));
        }

        $categoria = $this->categoriaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/categorias.singular')]));

        return redirect(route('categorias.index'));
    }

    /**
     * Remove the specified categoria from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoria = $this->categoriaRepository->find($id);

        if (empty($categoria)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categorias.singular')]));

            return redirect(route('categorias.index'));
        }

        $this->categoriaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/categorias.singular')]));

        return redirect(route('categorias.index'));
    }
}
