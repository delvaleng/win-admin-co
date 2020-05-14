<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreateTpDocumentoIdentidadRequest;
use App\Http\Requests\UpdateTpDocumentoIdentidadRequest;
use App\Repositories\TpDocumentoIdentidadRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpDocumentoIdentidadController extends AppBaseController
{
    /** @var  TpDocumentoIdentidadRepository */
    private $tpDocumentoIdentidadRepository;

    public function __construct(TpDocumentoIdentidadRepository $tpDocumentoIdentidadRepo)
    {
        $this->tpDocumentoIdentidadRepository = $tpDocumentoIdentidadRepo;
    }

    /**
     * Display a listing of the TpDocumentoIdentidad.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $tpDocumentoIdentidads = $this->tpDocumentoIdentidadRepository->all();

      return view('tp_documento_identidads.index')
      ->with('tpDocumentoIdentidads', $tpDocumentoIdentidads)
      ->with('main',                  $main);
    }

    /**
     * Show the form for creating a new TpDocumentoIdentidad.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      return view('tp_documento_identidads.create')
      ->with('main', $main);
    }

    /**
     * Store a newly created TpDocumentoIdentidad in storage.
     *
     * @param CreateTpDocumentoIdentidadRequest $request
     *
     * @return Response
     */
    public function store(CreateTpDocumentoIdentidadRequest $request)
    {
        $input = $request->all();

        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->create($input);

        Flash::success('Documento Identidad guardado exitosamente.');

        return redirect(route('tpDocumentoIdentidads.index'));
    }

    /**
     * Display the specified TpDocumentoIdentidad.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->find($id);

        if (empty($tpDocumentoIdentidad)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tpDocumentoIdentidads.index'));
        }

        return view('tp_documento_identidads.show')
        ->with('tpDocumentoIdentidad', $tpDocumentoIdentidad)
        ->with('main',                 $main);
    }

    /**
     * Show the form for editing the specified TpDocumentoIdentidad.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->find($id);

        if (empty($tpDocumentoIdentidad)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tpDocumentoIdentidads.index'));
        }

        return view('tp_documento_identidads.edit')
        ->with('tpDocumentoIdentidad', $tpDocumentoIdentidad)
        ->with('main',                 $main);
    }

    /**
     * Update the specified TpDocumentoIdentidad in storage.
     *
     * @param int $id
     * @param UpdateTpDocumentoIdentidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpDocumentoIdentidadRequest $request)
    {
        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->find($id);

        if (empty($tpDocumentoIdentidad)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tpDocumentoIdentidads.index'));
        }

        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->update($request->all(), $id);

        Flash::success('Documento Identidad actualizada exitosamente.');

        return redirect(route('tpDocumentoIdentidads.index'));
    }

    /**
     * Remove the specified TpDocumentoIdentidad from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpDocumentoIdentidad = $this->tpDocumentoIdentidadRepository->find($id);

        if (empty($tpDocumentoIdentidad)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tpDocumentoIdentidads.index'));
        }

        $this->tpDocumentoIdentidadRepository->delete($id);

        Flash::success('Documento Identidad eliminado exitosamente.');

        return redirect(route('tpDocumentoIdentidads.index'));
    }
}
