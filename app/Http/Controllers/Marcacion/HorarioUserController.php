<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Marcaciones\Horario;
use App\Models\Marcaciones\HorarioUser;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Illuminate\Support\Facades\DB;
use Flash;
use Response;

class HorarioUserController extends AppBaseController
{
  private $menuid = 15;

  public function validPermisoMenu() {
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

    /**
     * Display a listing of the HorarioUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
        $horarioUsers = HorarioUser::all();

        return view('horario_users.index')
        ->with('horarioUsers', $horarioUsers)
        ->with('main',         $main);
    }

    /**
     * Show the form for creating a new HorarioUser.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $empleado       =  User::where('status', TRUE)->where('employe', true)
      ->select(DB::raw("UPPER(CONCAT(last_name,'  ', first_name)) AS name"), "users.id as id")
      ->orderBy('name',  'ASC')
      ->pluck( '(last_name||" " ||first_name)as name', 'users.id as id');

      $dias= [
        'Lunes'     =>'Lunes',
        'Martes'    =>'Martes',
        'Miercoles' =>'Miercoles',
        'Jueves'    =>'Jueves',
        'Viernes'   =>'Viernes',
        'Sabado'    =>'Sabado',
        'Domingo'   =>'Domingo',
      ];


        return view('horario_users.create', compact('empleado', 'dias'))
        ->with('main', $main);
    }

    /**
     * Store a newly created HorarioUser in storage.
     *
     * @param CreateHorarioUserRequest $request
     *
     * @return Response
     */
    public function store()
    {

        $data  = request()->all();

        $input = [
          'id_user' => $data{'id_user'},
        ];
        $existeHorarioUser = HorarioUser::where('id_user', $data{'id_user'} )->first();
        if($existeHorarioUser){
          $id_horario_user =  $existeHorarioUser->id;
        }else {
          $horarioUser = HorarioUser::create($input);
          $id_horario_user =  $horarioUser->id;
        }



        foreach ($data{'dia'} as $key) {
          // code...
          $horario = [
            'id_horario_user' => $id_horario_user,
            'dia'             => $key,
            'entrada'         => $data{'entrada'},
            'salida'          => $data{'salida'},
          ];

          $existeHorario = Horario::where('id_horario_user', $id_horario_user)->where('dia',$key)->first();
          if($existeHorario){
            $existeHorario->update($horario);
          }else{
            Horario::create($horario);
          }

        }

        Flash::success('Horario Usuarios guardado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.index'));
    }

    /**
     * Display the specified HorarioUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
        $horarioUser = HorarioUser::find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');
            return redirect(route('marcaciones-conf-horarios.index'));
        }
        $horarios  = Horario::where('id_horario_user', $id)->get();

        return view('horario_users.show')
        ->with('horarioUser', $horarioUser)
        ->with('horarios',    $horarios)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified HorarioUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $horarioUser = HorarioUser::find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('marcaciones-conf-horarios.index'));
        }
        $empleado       =  User::where('status', TRUE)->where('employe', true)
        ->select(DB::raw("UPPER(CONCAT(last_name,'  ', first_name)) AS name"), "users.id as id")
        ->orderBy('name',  'ASC')
        ->pluck( '(last_name||" " ||first_name)as name', 'users.id as id');

        $dias= [
          'Lunes'     =>'Lunes',
          'Martes'    =>'Martes',
          'Miercoles' =>'Miercoles',
          'Jueves'    =>'Jueves',
          'Viernes'   =>'Viernes',
          'Sabado'    =>'Sabado',
          'Domingo'   =>'Domingo',
        ];


        return view('horario_users.edit')
        ->with('horarioUser', $horarioUser)
        ->with('empleado',    $empleado)
        ->with('dias',        $dias)
        ->with('main',        $main);
    }

    /**
     * Update the specified HorarioUser in storage.
     *
     * @param int $id
     * @param UpdateHorarioUserRequest $request
     *
     * @return Response
     */
    public function update($id)
    {
        $horarioUser = HorarioUser::find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('horarioUsers.index'));
        }

        $data  = request()->all();

        $input = [
          'id_user' => $data{'id_user'},
        ];
        $existeHorarioUser = HorarioUser::where('id_user', $data{'id_user'} )->first();
        if($existeHorarioUser){
          $id_horario_user =  $existeHorarioUser->id;
        }else {
          $horarioUser = HorarioUser::create($input);
          $id_horario_user =  $horarioUser->id;
        }



        foreach ($data{'dia'} as $key) {
          // code...
          $horario = [
            'id_horario_user' => $id_horario_user,
            'dia'             => $key,
            'entrada'         => $data{'entrada'},
            'salida'          => $data{'salida'},
          ];

          $existeHorario = Horario::where('id_horario_user', $id_horario_user)->where('dia',$key)->first();
          if($existeHorario){
            $existeHorario->update($horario);
          }else{
            Horario::create($horario);
          }

        }

        Flash::success('Horario Usuarios actualizado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.show', [$id]));
    }

    /**
     * Remove the specified HorarioUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $horarioUser = HorarioUser::find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('marcaciones-conf-horarios.index'));
        }

        HorarioUser::delete($id);

        Flash::success('Horario Usuarios eliminado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.index'));
    }
}
