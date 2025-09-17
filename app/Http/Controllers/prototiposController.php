<?php

namespace App\Http\Controllers;

use App\DataTables\prototiposDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateprototiposRequest;
use App\Http\Requests\UpdateprototiposRequest;
use App\Repositories\prototiposRepository;
use App\Repositories\imagem_produtoRepository;
use App\Repositories\clienteRepository;
use App\Repositories\ilustradorRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class prototiposController extends AppBaseController
{
    /** @var prototiposRepository $prototiposRepository*/
    /** @var imagem_produtoRepository $imagem_produtoRepository*/
    /** @var clienteRepository $clienteRepository*/
    /** @var ilustradorRepository $ilustradorRepository*/


    private $prototiposRepository;
    private $imagem_produtoRepository;
    private $clienteRepository;
    private $ilustradorRepository;

    public function __construct(prototiposRepository $prototiposRepo , imagem_produtoRepository $imagem_produtoRepo, clienteRepository $clienteRepo, ilustradorRepository $ilustradorRepo)
    {
        $this->prototiposRepository = $prototiposRepo;
        $this->imagem_produtoRepository = $imagem_produtoRepo;
        $this->clienteRepository = $clienteRepo;
        $this->ilustradorRepository =$ilustradorRepo;
    }

    /**
     * Display a listing of the prototipos.
     *
     * @param prototiposDataTable $prototiposDataTable
     *
     * @return Response
     */
    public function index(prototiposDataTable $prototiposDataTable)
    {
        return $prototiposDataTable->render('prototipos.index');
    }

    /**
     * Show the form for creating a new prototipos.
     *
     * @return Response
     */
    public function create()
    {
        return view('prototipos.create')->with([
            'imagem_produto' =>$this->imagem_produtoRepository->all()->pluck('nome', 'id'),
            'cliente' =>$this->clienteRepository->all()->pluck('nome', 'id'),
            'ilustrador' =>$this->ilustradorRepository->all()->pluck('nome_ilustrador', 'id')
        ]);
    }

    /**
     * Store a newly created prototipos in storage.
     *
     * @param CreateprototiposRequest $request
     *
     * @return Response
     */
    public function store(CreateprototiposRequest $request)
    {
        $input = $request->all();

        $prototipos = $this->prototiposRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/prototipos.singular')]));

        return redirect(route('prototipos.index'));
    }

    /**
     * Display the specified prototipos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/prototipos.singular')]));

            return redirect(route('prototipos.index'));
        }

        return view('prototipos.show')->with('prototipos', $prototipos);
    }

    /**
     * Show the form for editing the specified prototipos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/prototipos.singular')]));

            return redirect(route('prototipos.index'));
        }

        return view('prototipos.edit')->with([
            'prototipos', $prototipos,
            'imagem_produto' =>$this->imagem_produtoRepository->all()->pluck('nome', 'id'),
            'cliente'=>$this->clienteRepository->all()->pluck('name','id'),
            'ilustrador' =>$this->ilustradorRepository->all()->pluck('nome', 'id')
        ]);
    }

    /**
     * Update the specified prototipos in storage.
     *
     * @param int $id
     * @param UpdateprototiposRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprototiposRequest $request)
    {
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/prototipos.singular')]));

            return redirect(route('prototipos.index'));
        }

        $prototipos = $this->prototiposRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/prototipos.singular')]));

        return redirect(route('prototipos.index'));
    }

    /**
     * Remove the specified prototipos from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $prototipos = $this->prototiposRepository->find($id);

        if (empty($prototipos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/prototipos.singular')]));

            return redirect(route('prototipos.index'));
        }

        $this->prototiposRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/prototipos.singular')]));

        return redirect(route('prototipos.index'));
    }
}
