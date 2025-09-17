<?php

namespace App\Http\Controllers;

use App\DataTables\arquivoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatearquivoRequest;
use App\Http\Requests\UpdatearquivoRequest;
use App\Repositories\arquivoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class arquivoController extends AppBaseController
{
    /** @var arquivoRepository $arquivoRepository*/
    private $arquivoRepository;

    public function __construct(arquivoRepository $arquivoRepo)
    {
        $this->arquivoRepository = $arquivoRepo;
    }

    /**
     * Display a listing of the arquivo.
     *
     * @param arquivoDataTable $arquivoDataTable
     *
     * @return Response
     */
    public function index(arquivoDataTable $arquivoDataTable)
    {
        return $arquivoDataTable->render('arquivos.index');
    }

    /**
     * Show the form for creating a new arquivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('arquivos.create');
    }

    /**
     * Store a newly created arquivo in storage.
     *
     * @param CreatearquivoRequest $request
     *
     * @return Response
     */
    public function store(CreatearquivoRequest $request)
    {
        $input = $request->all();

        $arquivo = $this->arquivoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/arquivos.singular')]));

        return redirect(route('arquivos.index'));
    }

    /**
     * Display the specified arquivo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivos.singular')]));

            return redirect(route('arquivos.index'));
        }

        return view('arquivos.show')->with('arquivo', $arquivo);
    }

    /**
     * Show the form for editing the specified arquivo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivos.singular')]));

            return redirect(route('arquivos.index'));
        }

        return view('arquivos.edit')->with('arquivo', $arquivo);
    }

    /**
     * Update the specified arquivo in storage.
     *
     * @param int $id
     * @param UpdatearquivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearquivoRequest $request)
    {
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivos.singular')]));

            return redirect(route('arquivos.index'));
        }

        $arquivo = $this->arquivoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/arquivos.singular')]));

        return redirect(route('arquivos.index'));
    }

    /**
     * Remove the specified arquivo from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $arquivo = $this->arquivoRepository->find($id);

        if (empty($arquivo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/arquivos.singular')]));

            return redirect(route('arquivos.index'));
        }

        $this->arquivoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/arquivos.singular')]));

        return redirect(route('arquivos.index'));
    }
}
