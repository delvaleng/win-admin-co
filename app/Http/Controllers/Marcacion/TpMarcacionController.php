<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreateTpMarcacionRequest;
use App\Http\Requests\UpdateTpMarcacionRequest;
use App\Repositories\TpMarcacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpMarcacionController extends AppBaseController
{
    /** @var  TpMarcacionRepository */
    private $tpMarcacionRepository;

    public function __construct(TpMarcacionRepository $tpMarcacionRepo)
    {
        $this->tpMarcacionRepository = $tpMarcacionRepo;
    }

    /**
     * Display a listing of the TpMarcacion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpMarcacions = $this->tpMarcacionRepository->all();

        return view('tp_marcacions.index')
        ->with('tpMarcacions', $tpMarcacions)
        ->with('main',         $main);
    }

    /**
     * Show the form for creating a new TpMarcacion.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      return view('tp_marcacions.create')
      ->with('main', $main);
    }

    /**
     * Store a newly created TpMarcacion in storage.
     *
     * @param CreateTpMarcacionRequest $request
     *
     * @return Response
     */
    public function store(CreateTpMarcacionRequest $request)
    {
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $tpMarcacion = $this->tpMarcacionRepository->create($input);

        Flash::success('Marcacion guardada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }

    /**
     * Display the specified TpMarcacion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpMarcacion = $this->tpMarcacionRepository->find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        return view('tp_marcacions.show')
        ->with('tpMarcacion', $tpMarcacion)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified TpMarcacion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpMarcacion = $this->tpMarcacionRepository->find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        return view('tp_marcacions.edit')
        ->with('tpMarcacion', $tpMarcacion)
        ->with('main',        $main);
    }

    /**
     * Update the specified TpMarcacion in storage.
     *
     * @param int $id
     * @param UpdateTpMarcacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpMarcacionRequest $request)
    {
        $tpMarcacion = $this->tpMarcacionRepository->find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $tpMarcacion = $this->tpMarcacionRepository->update($input, $id);

        Flash::success('Marcacion actualizada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }

    /**
     * Remove the specified TpMarcacion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpMarcacion = $this->tpMarcacionRepository->find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        $this->tpMarcacionRepository->delete($id);

        Flash::success('Marcacion eliminada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }
}
