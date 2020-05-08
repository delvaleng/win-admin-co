<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreatePasswordoEmpleadoRequest;
use App\Http\Requests\UpdatePasswordoEmpleadoRequest;
use App\Repositories\PasswordoEmpleadoRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordoEmpleado;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class PasswordoEmpleadoController extends AppBaseController
{
    /** @var  PasswordoEmpleadoRepository */
    private $passwordoEmpleadoRepository;

    public function __construct(PasswordoEmpleadoRepository $passwordoEmpleadoRepo)
    {
        $this->passwordoEmpleadoRepository = $passwordoEmpleadoRepo;
    }

    /**
     * Display a listing of the PasswordoEmpleado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $passwordoEmpleados = $this->passwordoEmpleadoRepository->all();

        return view('passwordo_empleados.index')
            ->with('passwordoEmpleados', $passwordoEmpleados)
            ->with('main', $main);
    }

    /**
     * Show the form for creating a new PasswordoEmpleado.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        $empleado       =  Empleado::where('status', TRUE)
        ->select(DB::raw("UPPER(CONCAT(apellido,'  ', nombre)) AS name"), "empleados.id as id")
        ->orderBy('name',  'ASC')
        ->pluck( '(apellido||" " ||nombre)as name', 'empleados.id as id');


        return view('passwordo_empleados.create',compact('empleado'))
        ->with('main', $main);
    }

    /**
     * Store a newly created PasswordoEmpleado in storage.
     *
     * @param CreatePasswordoEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreatePasswordoEmpleadoRequest $request)
    {
        $input = $request->all();

        $paswold = PasswordoEmpleado::where('id_empleado', $input{'id_empleado'})->get();
        foreach($paswold as $key => $cont) {
            $data = array($cont->status = false);
            $cont->update($data);
        }


        $passwordoEmpleado = $this->passwordoEmpleadoRepository->create($input);

        Flash::success('Contraseña Empleado guardado exitosamente.');

        return redirect(route('passwordoEmpleados.index'));
    }

    /**
     * Display the specified PasswordoEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $passwordoEmpleado = $this->passwordoEmpleadoRepository->find($id);

        if (empty($passwordoEmpleado)) {
            Flash::error('Contraseña Empleado no encontrada');

            return redirect(route('passwordoEmpleados.index'));
        }

        return view('passwordo_empleados.show')
        ->with('passwordoEmpleado', $passwordoEmpleado)
        ->with('main', $main);
    }

    /**
     * Show the form for editing the specified PasswordoEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $passwordoEmpleado = $this->passwordoEmpleadoRepository->find($id);
        $empleado       =  Empleado::where('status', TRUE)
        ->select(DB::raw("UPPER(CONCAT(apellido,'  ', nombre)) AS name"), "empleados.id as id")
        ->orderBy('name',  'ASC')
        ->pluck( '(apellido||" " ||nombre)as name', 'empleados.id as id');



        if (empty($passwordoEmpleado)) {
            Flash::error('Contraseña Empleado no encontrada');

            return redirect(route('passwordoEmpleados.index'));
        }

        return view('passwordo_empleados.edit')
        ->with('empleado', $empleado)
        ->with('passwordoEmpleado', $passwordoEmpleado)
        ->with('main', $main);
    }

    /**
     * Update the specified PasswordoEmpleado in storage.
     *
     * @param int $id
     * @param UpdatePasswordoEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePasswordoEmpleadoRequest $request)
    {
        $passwordoEmpleado = $this->passwordoEmpleadoRepository->find($id);

        if (empty($passwordoEmpleado)) {
            Flash::error('Contraseña Empleado no encontrada');

            return redirect(route('passwordoEmpleados.index'));
        }
        $input = $request->all();
        $input{'status'} = 1;
        $paswold = PasswordoEmpleado::where('id_empleado', $input{'id_empleado'})->get();
        foreach($paswold as $key => $cont) {
            $data = array($cont->status = false);
            $cont->update($data);
        }


        $passwordoEmpleado = $this->passwordoEmpleadoRepository->update($input, $id);

        Flash::success('Contraseña Empleado actualizada exitosamente.');

        return redirect(route('passwordoEmpleados.index'));
    }

    /**
     * Remove the specified PasswordoEmpleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $passwordoEmpleado = $this->passwordoEmpleadoRepository->find($id);

        if (empty($passwordoEmpleado)) {
            Flash::error('Contraseña Empleado no encontrada');

            return redirect(route('passwordoEmpleados.index'));
        }

        $this->passwordoEmpleadoRepository->delete($id);

        Flash::success('Contraseña Empleado eliminada exitosamente.');

        return redirect(route('passwordoEmpleados.index'));
    }
}
