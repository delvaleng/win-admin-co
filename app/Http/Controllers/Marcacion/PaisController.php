<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreatePaisRequest;
use App\Http\Requests\UpdatePaisRequest;
use App\Repositories\PaisRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class PaisController extends AppBaseController
{
    /** @var  PaisRepository */
    private $paisRepository;

    public function __construct(PaisRepository $paisRepo)
    {
        $this->paisRepository = $paisRepo;
    }

    /**
     * Display a listing of the Pais.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $pais = $this->paisRepository->all();

        return view('pais.index')
            ->with('pais', $pais)
            ->with('main', $main);
    }

    /**
     * Show the form for creating a new Pais.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        return view('pais.create')
        ->with('main', $main);
    }

    /**
     * Store a newly created Pais in storage.
     *
     * @param CreatePaisRequest $request
     *
     * @return Response
     */
    public function store(CreatePaisRequest $request)
    {
        $input = $request->all();
        $input{'country'} = mb_strtoupper($input{'country'});

        $pais = $this->paisRepository->create($input);

        Flash::success('País guardado exitosamente.');

        return redirect(route('pais.index'));
    }

    /**
     * Display the specified Pais.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $pais = $this->paisRepository->find($id);

        if (empty($pais)) {
            Flash::error('País no encontrado');

            return redirect(route('pais.index'));
        }

        return view('pais.show')
        ->with('pais', $pais)
        ->with('main', $main);
    }

    /**
     * Show the form for editing the specified Pais.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $pais = $this->paisRepository->find($id);

        if (empty($pais)) {
            Flash::error('País no encontrado');

            return redirect(route('pais.index'));
        }

        return view('pais.edit')
        ->with('pais', $pais)
        ->with('main', $main);
    }

    /**
     * Update the specified Pais in storage.
     *
     * @param int $id
     * @param UpdatePaisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaisRequest $request)
    {
        $pais = $this->paisRepository->find($id);

        if (empty($pais)) {
            Flash::error('País no encontrado');

            return redirect(route('pais.index'));
        }
        $input = $request->all();
        $input{'country'} = mb_strtoupper($input{'country'});

        $pais = $this->paisRepository->update($input, $id);

        Flash::success('País actualizado exitosamente.');

        return redirect(route('pais.index'));
    }

    /**
     * Remove the specified Pais from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pais = $this->paisRepository->find($id);

        if (empty($pais)) {
            Flash::error('País no encontrado');

            return redirect(route('pais.index'));
        }

        $this->paisRepository->delete($id);

        Flash::success('País eliminado exitosamente.');

        return redirect(route('pais.index'));
    }
}
