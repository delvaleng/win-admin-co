<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Marcaciones\AutorizacionEmpleado;
use App\Models\Marcaciones\HorarioUser;
use App\Models\Marcaciones\Marcacion;
use App\Models\Marcaciones\Horario;

use App\Models\Admin\TpMarcacion;
use App\Models\Admin\User;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Flash;
use Excel;
use DateTime;
use Response;

class MarcacionController extends AppBaseController
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

    public function store()
    {

      if($this->isMobile() && auth()->user()->id != 2 && auth()->user()->id != 3  && auth()->user()->id != 5 && auth()->user()->id != 7){
        Flash::error('<li>¡Debes realizar la marcación desde un ordenador!</li>');
        return redirect(route('home'));
      }


      $input           = request()->all();
      // dd($input);
      // VALIDO QUE LOS DATOS REQUERIDOS
        $validator = \Validator::make($input, [
            'id_tp_marcacion' => 'required',
            'latitud'         => 'required',
          ],
          [
           'id_tp_marcacion.required' => 'El tipo de marcacion es un campo obligatorio.',
           'latitud.required'         => 'Debes activar tu ubicación.',
         ]);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          return \Redirect::back()->withErrors($errors);
        }
        $validDay = Marcacion::where('dia', date("Y-m-d"))->where('id_tp_marcacion', $input{'id_tp_marcacion'})->where('id_user', auth()->user()->id)->first();
        if ($validDay) {
          Flash::error('<li>Ya se registro este tipo de marcación</li>');
          return redirect(route('home'));
        }
      // VALIDO QUE LOS DATOS REQUERIDOS.
      try{
        DB::beginTransaction();
        $marcar =[
          'id_user'          => auth()->user()->id,
          'id_tp_marcacion'  => $input{'id_tp_marcacion'},
          'dia'              => date("Y-m-d"),
          'hora_inicio'      => date('H:i:s'),
          'observacion'      => $input{'observacion'},
          'latitud'          => $input{'latitud'},
          'longitud'         => $input{'longitud'},
          'ip_ubicacion'     => $this->getRealIP(),//$input{'longitud'},
          'dispositivo'      => 'ORDENADOR'
        ];
        Marcacion::create($marcar);

        if($input{'id_tp_marcacion'} > 1){

          $validDay      = Marcacion::where('dia', date("Y-m-d"))
          ->where('id_user', auth()->user()->id)
          ->where('id_tp_marcacion', '!=', $input{'id_tp_marcacion'})
          ->orderBy('created_at', 'desc')->first();
          // dd($validDay);


          $fecha1 = \DateTime::createFromFormat('Y-m-d H:i:s',$validDay->created_at ); //new DateTime("2010-07-28 01:15:52");
          $fecha2 = new DateTime(now());
          $fecha    = $fecha1->diff($fecha2);
          $hora     = $fecha->format('%H');
          $minutos  = $fecha->format('%i');


          $validDay->hora_fin  = date('H:i:s');
          $validDay->total_min = $minutos+($hora*60);
          $validDay->update();
        }

          DB::commit();
         }catch(\Exception $e){
           // dd($e);
              DB::rollback();
              Flash::error('<li>No hemos podido registrar tu marcacion. </li>');
              return redirect(route('home'));
          }
          Flash::success('<li>Marcacion guardada correctamente.</li>');
          return redirect(route('home'));


    }

    public function index( )
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpempleado       =  User::where('status', TRUE)->where('employe', true)
      ->select(DB::raw("UPPER(CONCAT(last_name,'  ', first_name)) AS name"), "users.id as id")
      ->orderBy('name',  'ASC')
      ->pluck( '(last_name||" " ||first_name)as name', 'users.id as id');

        return view('marcacions.index')
        ->with('tpempleado', $tpempleado)
        ->with('main',       $main);

    }

    public function getMarcacions()
    {
      // code...
      $formulario  = request()->formulario;
      $marcacions  = (new Marcacion)->with('empleado', 'tpMarcacion')->newQuery();

      $startDate  = ($formulario{'startDate'})?  $formulario{'startDate'} : null;   unset( $formulario{'startDate'});
      $endDate    = ($formulario{'endDate'}  )?  $formulario{'endDate'}   : null;   unset( $formulario{'endDate'});

      if($startDate != null && $endDate != null)       {
        $marcacions  = $marcacions->whereBetween('dia',  [date("Y-m-d", strtotime($startDate) ), date("Y-m-d", strtotime($endDate  ) ) ] ); }

      if ($formulario{'id_empleado'}) {
        $marcacions  = $marcacions->where('id_user', $formulario{'id_empleado'});
      }

          $marcacions = $marcacions->get();

          return response()->json([
            'data' => $marcacions,
          ]);

    }





    public function marcacionsMaps($long, $lat)
    {
      $long=$long; $lat=$lat;
      return view('marcacions.maps', compact('long','lat'));
    }


    public function report()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpempleado  =  User::where('employe', true)
            ->select(DB::raw("UPPER(CONCAT(last_name,'  ', first_name)) AS name"), "users.id as id")
            ->orderBy('name',  'ASC')
            ->pluck( '(last_name||" " ||first_name)as name', 'users.id as id');


      return view('marcacions.report', compact('tpempleado'))
      ->with('main', $main);
    }





    public function reportSearch()
    {
      $datos =[];
      $formulario  = request()->formulario;

      $marcacions  = (new Marcacion)->newQuery();
      if ($formulario{'id_empleado'}) {
        $marcacions  = $marcacions->where('id_user', $formulario{'id_empleado'});
      }

      $marcacions  = $marcacions->whereBetween('dia',[$formulario{'startDate'}, $formulario{'endDate'}] );
      $marcacions  = $marcacions->where('id_tp_marcacion','1');
      $marcacions  = $marcacions->with('empleado', 'tpMarcacion')->orderBy('dia', 'asc')->get();

      $i = 0;
      $total_positivo = 0;
      $total_negativo = 0;

      foreach ($marcacions as $key) {

        $dia_letra     =  $this->conocerDiaSemanaFecha($key->dia);
        $horarioUser   = HorarioUser::where('id_user', $key->id_user)->first();

        $searchHorario = Horario::where('dia',   $dia_letra)->where('id_horario_user', $horarioUser->id)->first();
        $salidaQuery   = Marcacion::where('dia', $key->dia )
          ->where('id_tp_marcacion', 4)
          ->where('id_user', $key->id_user)
          ->first();

        $entrada       = $searchHorario->entrada;
        $salida        = $searchHorario->salida;

        $hora_inicio   = $key->hora_inicio;
        $hora_salida   = ($salidaQuery)? $salidaQuery->hora_inicio : null;

        //HORAS DE ENTRADA
        $resto_entrada  = $this->restoHoras($entrada, $hora_inicio, 'entrada', $key->id);

        $total_positivo = ($resto_entrada{'tp'} == 'suma' )? $total_positivo + $resto_entrada{'minutos'} : $total_positivo;

        $total_negativo = ($resto_entrada{'tp'} == 'resto' && $resto_entrada{'autorizado'} == null)?
        $total_negativo + $resto_entrada{'minutos'} : $total_negativo;
        //HORAS DE ENTRADA

        //HORAS DE SALIDA
        $resto_salida   = ($hora_salida != null ) ? $this->restoHoras($salida,  $hora_salida, 'salida', $salidaQuery->id) : null;

        $total_positivo = ($resto_salida!= null)?
        ($resto_salida{'tp'} == 'suma' )? $total_positivo + $resto_salida{'minutos'} : $total_positivo
        : $total_positivo;
        $total_negativo= ($resto_salida!= null)?
        ($resto_salida{'tp'} == 'resto' && $resto_salida{'autorizado'} == null)? $total_negativo + $resto_salida{'minutos'} : $total_negativo
        : $total_negativo;
        //HORAS DE SALIDA


        $dato = [
          'id'                  => $key->id,
          'num'                 => ++$i,
          'nombre'              => ($key->id_user) ? $key->empleado->first_name   : '-',
          'apellido'            => ($key->id_user) ? $key->empleado->last_name    : '-',
          'dia_letra'           => $dia_letra,
          'fecha'               => date_format( $key->dia, 'd-m-Y'),
          'entrada'             => date("g:i a",strtotime($entrada)),
          'hora_inicio'         => date("g:i a",strtotime($hora_inicio)),
          'resto_entrada'       => $resto_entrada{'minutos'},
          'tp_resto_entrada'    => $resto_entrada{'tp'},
          'salida'              => date("g:i a",strtotime($salida)),
          'hora_salida'         => ($hora_salida == null)? 'NO MARCO' : date("g:i a",strtotime($hora_salida)),
          'resto_salida'        => $resto_salida{'minutos'},
          'tp_resto_salida'     => $resto_salida{'tp'},
          'total_positivo'      => $total_positivo,
          'total_negativo'      => $total_negativo,
          'autorizado_salida'   => $resto_salida {'autorizado'},
          'autorizado_entrada'  => $resto_entrada{'autorizado'},
          'observacion_salida'  => $resto_salida {'observacion'},
          'observacion_entrada' => $resto_entrada{'observacion'},
        ];
        array_push($datos, $dato);

        $total_positivo = 0;
        $total_negativo = 0;
      }

      return response()->json(["data"=>$datos]);

    }


    function conocerDiaSemanaFecha($fecha)
    {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }


    function restoHoras($standar, $marco, $tp, $id)
    {
      $autorizado = null;
      $observacion = null;

      $queryAutorizacion = AutorizacionEmpleado::where('id_marcacion', $id)->with('aprobadoBy')->first();
      if($queryAutorizacion){
          $autorizado  = ($queryAutorizacion->aprobado_by)? mb_strtoupper($queryAutorizacion->aprobadoBy->usuario) : '-';
          $observacion = mb_strtoupper($queryAutorizacion->observacion);
      }
      $inicio;      $final;   $tp_cuenta;

      if ($tp == 'entrada'){
        $hora1 = strtotime( $standar);
        $hora2 = strtotime( $marco  );
        if( $hora1 < $hora2 ) {
          $inicio = $standar;
          $final  = $marco;
          $tp_cuenta ='resto';

        }else {
          $inicio = $marco;
          $final  = $standar;
          $tp_cuenta ='suma';
        }
      }

      if ($tp == 'salida'){
        $hora1 = strtotime( $standar);
        $hora2 = strtotime( $marco  );
        if( $hora1 > $hora2 ) {
          $inicio   = $marco;
          $final     = $standar;
          $tp_cuenta ='resto';
        }
        else {
          $inicio = $standar;
          $final  = $marco;
          $tp_cuenta ='suma';
        }
      }

      $horaInicio  = new DateTime($inicio);
      $horaTermino = new DateTime($final);

      $interval = $horaInicio->diff($horaTermino);


      $hora     = $interval->format('%H');
      $minutos  = $interval->format('%i');
      $total    = $minutos+($hora*60);

      return $dato =[
        'minutos' => $total,
        'tp'      => $tp_cuenta,
        'autorizado'  => $autorizado,
        'observacion' => $observacion,
      ];
    }


    function getRealIP()
    {

     if (isset($_SERVER["HTTP_CLIENT_IP"])){

         return $_SERVER["HTTP_CLIENT_IP"];

     }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

         return $_SERVER["HTTP_X_FORWARDED_FOR"];

     }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

         return $_SERVER["HTTP_X_FORWARDED"];

     }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

         return $_SERVER["HTTP_FORWARDED_FOR"];

     }elseif (isset($_SERVER["HTTP_FORWARDED"])){

         return $_SERVER["HTTP_FORWARDED"];

     }else{

         return $_SERVER["REMOTE_ADDR"];

     }
    }




    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $marcacion = $this->marcacionRepository->find($id);

        if (empty($marcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('marcacions.index'));
        }

        return view('marcacions.show')
        ->with('marcacion', $marcacion)
        ->with('main',      $main);
    }

    /**@valido que sea mobile o no!  */
    function isMobile() {
      return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini
    |mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }


}
