<?php

namespace App\Http\Controllers;

use App\DataTables\tipo_arquivoDataTable;
use App\Http\Requests;
use App\Http\Requests\Createtipo_arquivoRequest;
use App\Http\Requests\Updatetipo_arquivoRequest;
use App\Repositories\tipo_arquivoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class tipo_arquivoController extends AppBaseController
{
    /** @var tipo_arquivoRepository $tipoArquivoRepository*/
    private $tipoArquivoRepository;

    public function __construct(tipo_arquivoRepository $tipoArquivoRepo)
    {
        $this->tipoArquivoRepository = $tipoArquivoRepo;
    }

    /**
     * Display a listing of the tipo_arquivo.
     *
     * @param tipo_arquivoDataTable $tipoArquivoDataTable
     *
     * @return Response
     */
    public function index(tipo_arquivoDataTable $tipoArquivoDataTable)
    {
        return $tipoArquivoDataTable->render('tipo_arquivos.index');
    }

    /**
     * Show the form for creating a new tipo_arquivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_arquivos.create');
    }

    /**
     * Store a newly created tipo_arquivo in storage.
     *
     * @param Createtipo_arquivoRequest $request
     *
     * @return Response
     */
    public function store(Createtipo_arquivoRequest $request)
    {
        $input = $request->all();

        $tipoArquivo = $this->tipoArquivoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tipoArquivos.singular')]));

        return redirect(route('tipoArquivos.index'));
    }

    /**
     * Display the specified tipo_arquivo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoArquivos.singular')]));

            return redirect(route('tipoArquivos.index'));
        }

        return view('tipo_arquivos.show')->with('tipoArquivo', $tipoArquivo);
    }

    /**
     * Show the form for editing the specified tipo_arquivo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoArquivos.singular')]));

            return redirect(route('tipoArquivos.index'));
        }

        return view('tipo_arquivos.edit')->with('tipoArquivo', $tipoArquivo);
    }

    /**
     * Update the specified tipo_arquivo in storage.
     *
     * @param int $id
     * @param Updatetipo_arquivoRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetipo_arquivoRequest $request)
    {
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoArquivos.singular')]));

            return redirect(route('tipoArquivos.index'));
        }

        $tipoArquivo = $this->tipoArquivoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tipoArquivos.singular')]));

        return redirect(route('tipoArquivos.index'));
    }

    /**
     * Remove the specified tipo_arquivo from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoArquivo = $this->tipoArquivoRepository->find($id);

        if (empty($tipoArquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoArquivos.singular')]));

            return redirect(route('tipoArquivos.index'));
        }

        $this->tipoArquivoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tipoArquivos.singular')]));

        return redirect(route('tipoArquivos.index'));
    }
}
