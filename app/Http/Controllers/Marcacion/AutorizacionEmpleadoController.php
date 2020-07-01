<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Marcaciones\AutorizacionEmpleado;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Flash;
use Response;

class AutorizacionEmpleadoController extends AppBaseController
{
    private $menuid = 9;

    public function validPermisoMenu()
    {
      $roles = RolUser::where('user_id', auth()->user()->id)->get();
      foreach ($roles as $key) {
        if($key->role_id == 1){
          return true;
        }
        else{
          $menu = RolMain::where('role_id', $key->role_id)
          ->where('main_id', $this->menuid)->first();
          if($menu){
            return true;
          }
        }
      }
      return false;
    }

    public function index()
    {
        $main = new MainClass();
        $main = $main->getMain();

        $valor = $this->validPermisoMenu();
        if ($valor == false){
          return view('errors.403', compact('main'));
        }


        return view('autorizacion_empleados.index')
        ->with('main', $main);
    }

    public function getAutorizaciones()
    {

      $data = (new AutorizacionEmpleado)->with('creadoBy', 'aprobadoBy','marcacion', 'getEmpleado', 'getTpMarcacion')->newQuery();
      $data = $data->get();

          return response()->json([
            'data' => $data,
          ]);

    }


    /**
     * Show the form for creating a new AutorizacionEmpleado.
     *
     * @return Response
     */

    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();
      return view('errors.403', compact('main'));

        return view('autorizacion_empleados.create')
        ->with('main', $main);
    }

    /**
     * Store a newly created AutorizacionEmpleado in storage.
     *
     * @param CreateAutorizacionEmpleadoRequest $request
     *
     * @return Response
     */
    public function store(CreateAutorizacionEmpleadoRequest $request)
    {
        $input = $request->all();

        $autorizacionEmpleado = AutorizacionEmpleado::create($input);

        Flash::success('Autorización Empleado guardada exitosamente.');

        return redirect(route('autorizacionEmpleados.index'));
    }

    public function searchAutorizacion()
    {
      $id_marcacion = request()->id_marcacion;
      $autorizacion = AutorizacionEmpleado::where('id_marcacion', $id_marcacion)->first();

      return response()->json(
        [ "data"   => $autorizacion,
          "object" => 'success'
        ]
      );
    }
    public function sendAutorizacion()
    {
      $formulario = request()->formulario;

      $data = [
        'id_marcacion'  => $formulario{'id_marcacion'},
        'creado_by'     => $formulario{'creado_by'},
        'aprobado_by'   => $formulario{'aprobado_by'},
        'observacion'   => $formulario{'observacion'},
      ];

      $autorizacion = AutorizacionEmpleado::where('id_marcacion', $formulario{'id_marcacion'})->first();
      if($autorizacion){
        $autorizacion->update($data);
      }else {
        AutorizacionEmpleado::create($data);
      }

      return response()->json(
        [ "object" => 'success'  ]
      );
    }

    /**
     * Display the specified AutorizacionEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $autorizacionEmpleado = AutorizacionEmpleado::find($id);

        if (empty($autorizacionEmpleado)) {
            Flash::error('Autorización Empleado no encontrada');

            return redirect(route('autorizacionEmpleados.index'));
        }

        return view('autorizacion_empleados.show')
        ->with('autorizacionEmpleado', $autorizacionEmpleado)
        ->with('main',                 $main);
    }

    /**
     * Show the form for editing the specified AutorizacionEmpleado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      return view('errors.403', compact('main'));

        $autorizacionEmpleado = AutorizacionEmpleado::find($id);

        if (empty($autorizacionEmpleado)) {
            Flash::error('Autorización Empleado no encontrada');

            return redirect(route('autorizacionEmpleados.index'));
        }

        return view('autorizacion_empleados.edit')
        ->with('autorizacionEmpleado', $autorizacionEmpleado)
        ->with('main',                 $main);
    }

    /**
     * Update the specified AutorizacionEmpleado in storage.
     *
     * @param int $id
     * @param UpdateAutorizacionEmpleadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutorizacionEmpleadoRequest $request)
    {
        $autorizacionEmpleado = AutorizacionEmpleado::find($id);

        if (empty($autorizacionEmpleado)) {
            Flash::error('Autorización Empleado no encontrada');

            return redirect(route('autorizacionEmpleados.index'));
        }

        $autorizacionEmpleado = AutorizacionEmpleado::update($request->all(), $id);

        Flash::success('Autorización Empleado actualizado exitosamente.');

        return redirect(route('autorizacionEmpleados.index'));
    }

    /**
     * Remove the specified AutorizacionEmpleado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $autorizacionEmpleado = AutorizacionEmpleado::find($id);

        if (empty($autorizacionEmpleado)) {
            Flash::error('Autorización Empleado no encontrada');

            return redirect(route('autorizacionEmpleados.index'));
        }

        AutorizacionEmpleado::delete($id);

        Flash::success('Autorización Empleado elimininada exitosamente.');

        return redirect(route('autorizacionEmpleados.index'));
    }
}
