<?php

namespace App\Http\Controllers;

use App\DataTables\corDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecorRequest;
use App\Http\Requests\UpdatecorRequest;
use App\Repositories\corRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class corController extends AppBaseController
{
    /** @var  corRepository */
    private $corRepository;

    public function __construct(corRepository $corRepo)
    {
        $this->corRepository = $corRepo;
    }

    /**
     * Display a listing of the cor.
     *
     * @param corDataTable $corDataTable
     * @return Response
     */
    public function index(corDataTable $corDataTable)
    {
        return $corDataTable->render('cors.index');
    }

    /**
     * Show the form for creating a new cor.
     *
     * @return Response
     */
    public function create()
    {
        return view('cors.create');
    }

    /**
     * Store a newly created cor in storage.
     *
     * @param CreatecorRequest $request
     *
     * @return Response
     */
    public function store(CreatecorRequest $request)
    {
        $input = $request->all();

        $cor = $this->corRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cors.singular')]));

        return redirect(route('cors.index'));
    }

    /**
     * Display the specified cor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cors.singular')]));

            return redirect(route('cors.index'));
        }

        return view('cors.show')->with('cor', $cor);
    }

    /**
     * Show the form for editing the specified cor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cors.singular')]));

            return redirect(route('cors.index'));
        }

        return view('cors.edit')->with('cor', $cor);
    }

    /**
     * Update the specified cor in storage.
     *
     * @param  int              $id
     * @param UpdatecorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecorRequest $request)
    {
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cors.singular')]));

            return redirect(route('cors.index'));
        }

        $cor = $this->corRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cors.singular')]));

        return redirect(route('cors.index'));
    }

    /**
     * Remove the specified cor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cors.singular')]));

            return redirect(route('cors.index'));
        }

        $this->corRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cors.singular')]));

        return redirect(route('cors.index'));
    }
}
