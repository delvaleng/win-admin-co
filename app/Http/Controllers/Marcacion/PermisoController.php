<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreatePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use App\Repositories\PermisoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PermisoController extends AppBaseController
{
    /** @var  PermisoRepository */
    private $permisoRepository;

    public function __construct(PermisoRepository $permisoRepo)
    {
        $this->permisoRepository = $permisoRepo;
    }

    /**
     * Display a listing of the Permiso.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $permisos = $this->permisoRepository->all();

        return view('permisos.index')
            ->with('permisos', $permisos);
    }

    /**
     * Show the form for creating a new Permiso.
     *
     * @return Response
     */
    public function create()
    {
        return view('permisos.create');
    }

    /**
     * Store a newly created Permiso in storage.
     *
     * @param CreatePermisoRequest $request
     *
     * @return Response
     */
    public function store(CreatePermisoRequest $request)
    {
        $input = $request->all();

        $permiso = $this->permisoRepository->create($input);

        Flash::success('Permiso guardado exitosamente.');

        return redirect(route('permisos.index'));
    }

    /**
     * Display the specified Permiso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        return view('permisos.show')->with('permiso', $permiso);
    }

    /**
     * Show the form for editing the specified Permiso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        return view('permisos.edit')->with('permiso', $permiso);
    }

    /**
     * Update the specified Permiso in storage.
     *
     * @param int $id
     * @param UpdatePermisoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermisoRequest $request)
    {
        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        $permiso = $this->permisoRepository->update($request->all(), $id);

        Flash::success('Permiso actualizado exitosamente.');

        return redirect(route('permisos.index'));
    }

    /**
     * Remove the specified Permiso from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permiso = $this->permisoRepository->find($id);

        if (empty($permiso)) {
            Flash::error('Permiso no encontrado');

            return redirect(route('permisos.index'));
        }

        $this->permisoRepository->delete($id);

        Flash::success('Permiso eliminado exitosamente.');

        return redirect(route('permisos.index'));
    }
}
