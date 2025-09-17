<?php

namespace App\Http\Controllers;

use App\DataTables\ilustradorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateilustradorRequest;
use App\Http\Requests\UpdateilustradorRequest;
use App\Repositories\ilustradorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ilustradorController extends AppBaseController
{
    /** @var ilustradorRepository $ilustradorRepository*/
    private $ilustradorRepository;

    public function __construct(ilustradorRepository $ilustradorRepo)
    {
        $this->ilustradorRepository = $ilustradorRepo;
    }

    /**
     * Display a listing of the ilustrador.
     *
     * @param ilustradorDataTable $ilustradorDataTable
     *
     * @return Response
     */
    public function index(ilustradorDataTable $ilustradorDataTable)
    {
        return $ilustradorDataTable->render('ilustradors.index');
    }

    /**
     * Show the form for creating a new ilustrador.
     *
     * @return Response
     */
    public function create()
    {
        return view('ilustradors.create');
    }

    /**
     * Store a newly created ilustrador in storage.
     *
     * @param CreateilustradorRequest $request
     *
     * @return Response
     */
    public function store(CreateilustradorRequest $request)
    {
        $input = $request->all();

        $ilustrador = $this->ilustradorRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/ilustradors.singular')]));

        return redirect(route('ilustradors.index'));
    }

    /**
     * Display the specified ilustrador.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ilustradors.singular')]));

            return redirect(route('ilustradors.index'));
        }

        return view('ilustradors.show')->with('ilustrador', $ilustrador);
    }

    /**
     * Show the form for editing the specified ilustrador.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ilustradors.singular')]));

            return redirect(route('ilustradors.index'));
        }

        return view('ilustradors.edit')->with('ilustrador', $ilustrador);
    }

    /**
     * Update the specified ilustrador in storage.
     *
     * @param int $id
     * @param UpdateilustradorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateilustradorRequest $request)
    {
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ilustradors.singular')]));

            return redirect(route('ilustradors.index'));
        }

        $ilustrador = $this->ilustradorRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/ilustradors.singular')]));

        return redirect(route('ilustradors.index'));
    }

    /**
     * Remove the specified ilustrador from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ilustrador = $this->ilustradorRepository->find($id);

        if (empty($ilustrador)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ilustradors.singular')]));

            return redirect(route('ilustradors.index'));
        }

        $this->ilustradorRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/ilustradors.singular')]));

        return redirect(route('ilustradors.index'));
    }
}
