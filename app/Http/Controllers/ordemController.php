<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\DataTables\ordemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateordemRequest;
use App\Http\Requests\UpdateordemRequest;
use App\Repositories\ordemRepository;
use App\Repositories\status_ordemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Helper;

class ordemController extends AppBaseController
{
    /** @var  ordemorRepository */
    private $ordemRepository;

    private $status_ordemRepository;


    public function __construct(ordemRepository $ordemRepo, status_ordemRepository $status_ordemRepo)
    {
        $this->ordemRepository = $ordemRepo;
        $this->status_ordemRepository = $status_ordemRepo;
    }

    /**
     * Display a listing of the ordem.
     *
     * @param ordemDataTable $ordemDataTable
     * @return Response
     */
    public function index(ordemDataTable $ordemDataTable)
    {
        return $ordemDataTable->render('ordems.index');
    }

    /**
     * Show the form for creating a new ordem.
     *
     * @return Response
     */
    public function create()
    {
        return view('ordems.create');
    }

    /**
     * Store a newly created ordem in storage.
     *
     * @param CreateordemRequest $request
     *
     * @return Response
     */
    public function store(CreateordemRequest $request)
    {
        $input = $request->all();
        $ordem = $this->ordemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/ordems.singular')]));

        return redirect(route('ordems.index'));
    }

    /**
     * Display the specified ordem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ordem = $this->ordemRepository->find($id);
        $status =$this->status_ordemRepository->find($id);

        if (empty($ordem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ordems.singular')]));

            return redirect(route('ordems.index'));
        }

        return view('ordems.show')->with('ordem', $ordem);
    }

    /**
     * Show the form for editing the specified ordem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ordem = $this->ordemRepository->find($id);

        if (empty($ordem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ordems.singular')]));

            return redirect(route('ordems.index'));
        }

        return view('ordems.edit')->with(['ordem'=>$ordem, 'status'=> $this->status_ordemRepository->all()->pluck('nome','id')]);
    }

    /**
     * Update the specified ordem in storage.
     *
     * @param  int              $id
     * @param UpdateordemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateordemRequest $request)
    {
      // dd(Carbon::createFromFormat('d/m/Y', $request->data_ini)->format('Y-m-d'));
        $ordem = $this->ordemRepository->find($id);
        $data_ordem = $request->all();
        $data_ordem['data_end']=  Carbon::createFromFormat('d/m/Y', $data_ordem['data_end'])->format('Y-m-d');

        $data_ordem['data_ini'] = Carbon::createFromFormat('d/m/Y', $data_ordem['data_ini'])->format('Y-m-d');


        if (empty($ordem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ordems.singular')]));

            return redirect(route('ordems.index'));
        }

        $ordem = $this->ordemRepository->update($data_ordem, $id);

        Flash::success(__('messages.updated', ['model' => __('models/ordems.singular')]));

        return redirect(route('ordems.index'));
    }

    /**
     * Remove the specified ordem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ordem = $this->ordemRepository->find($id);

        if (empty($ordem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ordems.singular')]));

            return redirect(route('ordems.index'));
        }

        $this->ordemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/ordems.singular')]));

        return redirect(route('ordems.index'));
    }
}
