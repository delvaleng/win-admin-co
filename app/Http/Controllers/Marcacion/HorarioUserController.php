<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Requests\CreateHorarioUserRequest;
use App\Http\Requests\UpdateHorarioUserRequest;
use App\Repositories\HorarioUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Horario;
use App\Models\HorarioUser;
use App\Models\General\Main;
use App\Classes\MainClass;

use Illuminate\Support\Facades\DB;
use Flash;
use Response;

class HorarioUserController extends AppBaseController
{
    /** @var  HorarioUserRepository */
    private $horarioUserRepository;

    public function __construct(HorarioUserRepository $horarioUserRepo)
    {
        $this->horarioUserRepository = $horarioUserRepo;
    }

    /**
     * Display a listing of the HorarioUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $horarioUsers = $this->horarioUserRepository->all();

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

      $empleado       =  Empleado::where('status', TRUE)
      ->select(DB::raw("UPPER(CONCAT(apellido,'  ', nombre)) AS name"), "empleados.id as id")
      ->orderBy('name',  'ASC')
      ->pluck( '(apellido||" " ||nombre)as name', 'empleados.id as id');

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
          'id_empleado' => $data{'id_empleado'},
        ];
        $existeHorarioUser = HorarioUser::where('id_empleado', $data{'id_empleado'} )->first();
        if($existeHorarioUser){
          $id_horario_user =  $existeHorarioUser->id;
        }else {
          $horarioUser = $this->horarioUserRepository->create($input);
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

        return redirect(route('horarioUsers.index'));
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

        $horarioUser = $this->horarioUserRepository->find($id);

        if (empty($horarioUser)) {

            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('horarioUsers.index'));
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

        $horarioUser = $this->horarioUserRepository->find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('horarioUsers.index'));
        }
        $empleado       =  Empleado::where('status', TRUE)
        ->select(DB::raw("UPPER(CONCAT(apellido,'  ', nombre)) AS name"), "empleados.id as id")
        ->orderBy('name',  'ASC')
        ->pluck( '(apellido||" " ||nombre)as name', 'empleados.id as id');

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
    public function update($id, UpdateHorarioUserRequest $request)
    {
        $horarioUser = $this->horarioUserRepository->find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('horarioUsers.index'));
        }

        $data  = request()->all();

        $input = [
          'id_empleado' => $data{'id_empleado'},
        ];
        $existeHorarioUser = HorarioUser::where('id_empleado', $data{'id_empleado'} )->first();
        if($existeHorarioUser){
          $id_horario_user =  $existeHorarioUser->id;
        }else {
          $horarioUser = $this->horarioUserRepository->create($input);
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

        return redirect(route('horarioUsers.index'));
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
        $horarioUser = $this->horarioUserRepository->find($id);

        if (empty($horarioUser)) {
            Flash::error('Horario Usuarios no encontrado');

            return redirect(route('horarioUsers.index'));
        }

        $this->horarioUserRepository->delete($id);

        Flash::success('Horario Usuarios eliminado exitosamente.');

        return redirect(route('horarioUsers.index'));
    }
}
