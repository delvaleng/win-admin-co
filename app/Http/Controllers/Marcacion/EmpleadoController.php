<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreateEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Repositories\EmpleadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\TpDocumentoIdentidad;
use App\Models\Pais;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class EmpleadoController extends AppBaseController
{
    /** @var  EmpleadoRepository */
    private $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepo)
    {
        $this->empleadoRepository = $empleadoRepo;
    }

    /**
     * Display a listing of the Empleado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $empleados = $this->empleadoRepository
        ->with('tpDocumentIdent', 'paisEmpleado')
        ->all();


        return view('empleados.index')
            ->with('empleados', $empleados)
            ->with('main',      $main);
    }

    /**
     * Show the form for creating a new Empleado.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $pais             = Pais::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
      $tpdocumentident  = TpDocumentoIdentidad::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

        return view('empleados.create', compact('pais', 'tpdocumentident'))
        ->with('main', $main);
    }

    /**
     * Store a newly created Empleado in storage.
     *
     * @param CreateEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpleadoRequest $request)
    {
        $input = $request->all();
        $input{'nombre'}    = strtoupper($input{'nombre'});
        $input{'apellido'}  = strtoupper($input{'apellido'});
        $input{'usuario'}   = strtolower($input{'usuario'});

        $empleado = $this->empleadoRepository->create($input);

        Flash::success('Empleado guardado exitosamente.');

        return redirect(route('empleados.index'));
    }

    /**
     * Display the specified Empleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }

        return view('empleados.show')
        ->with('empleado', $empleado)
        ->with('main', $main);
    }

    /**
     * Show the form for editing the specified Empleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $empleado          = $this->empleadoRepository->find($id);
        $pais              = Pais::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
        $tpdocumentident   = TpDocumentoIdentidad::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }

        return view('empleados.edit')
        ->with('pais',            $pais)
        ->with('tpdocumentident', $tpdocumentident)
        ->with('empleado',        $empleado)
        ->with('main',            $main);
    }

    /**
     * Update the specified Empleado in storage.
     *
     * @param int $id
     * @param UpdateEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpleadoRequest $request)
    {
        $empleado          = $this->empleadoRepository->find($id);
        $pais              = Pais                ::WHERE('status', '=', 'TRUE')->orderBy('country',     'ASC')->pluck('country',     'id');
        $tpdocumentident   = TpDocumentoIdentidad::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');


        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }
        $input              = $request->all();
        $input{'nombre'}    = strtoupper($input{'nombre'});
        $input{'apellido'}  = strtoupper($input{'apellido'});
        $input{'usuario'}   = strtolower($input{'usuario'});

        $empleado = $this->empleadoRepository->update($input, $id);

        Flash::success('Empleado actualizado exitosamente.');

        return redirect(route('empleados.index'));
    }

    /**
     * Remove the specified Empleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }

        $this->empleadoRepository->delete($id);

        Flash::success('Empleado eliminado exitosamente.');

        return redirect(route('empleados.index'));
    }
}
