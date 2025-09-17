<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createos_usinagemRequest;
use App\Http\Requests\Updateos_usinagemRequest;
use App\Repositories\os_usinagemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class os_usinagemController extends AppBaseController
{
    /** @var os_usinagemRepository $osUsinagemRepository*/
    private $osUsinagemRepository;

    public function __construct(os_usinagemRepository $osUsinagemRepo)
    {
        $this->osUsinagemRepository = $osUsinagemRepo;
    }

    /**
     * Display a listing of the os_usinagem.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $osUsinagems = $this->osUsinagemRepository->paginate(10);

        return view('os_usinagems.index')
            ->with('osUsinagems', $osUsinagems);
    }

    /**
     * Show the form for creating a new os_usinagem.
     *
     * @return Response
     */
    public function create()
    {
        return view('os_usinagems.create');
    }

    /**
     * Store a newly created os_usinagem in storage.
     *
     * @param Createos_usinagemRequest $request
     *
     * @return Response
     */
    public function store(Createos_usinagemRequest $request)
    {
        $input = $request->all();

        $osUsinagem = $this->osUsinagemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/osUsinagems.singular')]));

        return redirect(route('osUsinagems.index'));
    }

    /**
     * Display the specified os_usinagem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/osUsinagems.singular')]));

            return redirect(route('osUsinagems.index'));
        }

        return view('os_usinagems.show')->with('osUsinagem', $osUsinagem);
    }

    /**
     * Show the form for editing the specified os_usinagem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/osUsinagems.singular')]));

            return redirect(route('osUsinagems.index'));
        }

        return view('os_usinagems.edit')->with('osUsinagem', $osUsinagem);
    }

    /**
     * Update the specified os_usinagem in storage.
     *
     * @param int $id
     * @param Updateos_usinagemRequest $request
     *
     * @return Response
     */
    public function update($id, Updateos_usinagemRequest $request)
    {
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/osUsinagems.singular')]));

            return redirect(route('osUsinagems.index'));
        }

        $osUsinagem = $this->osUsinagemRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/osUsinagems.singular')]));

        return redirect(route('osUsinagems.index'));
    }

    /**
     * Remove the specified os_usinagem from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $osUsinagem = $this->osUsinagemRepository->find($id);

        if (empty($osUsinagem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/osUsinagems.singular')]));

            return redirect(route('osUsinagems.index'));
        }

        $this->osUsinagemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/osUsinagems.singular')]));

        return redirect(route('osUsinagems.index'));
    }
}
