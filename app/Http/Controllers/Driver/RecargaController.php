<?php

namespace App\Http\Controllers\Driver;

use App\Http\Requests\CreateAuditoriaRequest;
use App\Http\Requests\UpdateAuditoriaRequest;
use App\Repositories\AuditoriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\General\StatusRecarga;
use App\Models\General\Country;
use App\Models\General\TpPago;
use App\Models\General\TpBanco;
use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Main;
use App\Models\General\User;
use App\Models\Views\VRecargas;
use App\Models\Views\VRecargasPendientes;



use App\Classes\MainClass;
use App\Models\DriverSaldo;
use App\Models\DriverRecarga;
use App\Models\DriverRecargaDetalles;


use Flash;
use Response;

class RecargaController extends AppBaseController
{

  public function validPermisoMenu($id_main)
  {

    $roles = Rol_User::where('id_user', auth()->user()->id)->get();
    foreach ($roles as $key) {
      if($key->id_role == 2){
        return true;
      }
      else{
        $menu = Rol_Main::where('id_role', $key->id_role)->where('id_main', $id_main)->first();

        if($menu){
          return true;
        }
      }
    }
    return false;

  }

  public function getDataRecargaId()
  {
    $id_driver_recarga = request()->id_driver_recarga;
    $data       = VRecargas::where('id_driver_recarga', $id_driver_recarga)->first();

    return response()->json([
      'object'  => ($data)? 'success' : 'error',
      'message' => ($data)? 'Registro encontrado' : 'No encontramos su registro',
      'data'    =>  $data
    ]);
  }

  public function getDataPendientes()
  {
    $formulario = request()->formulario;
    $data       = (new VRecargasPendientes)->newQuery();
    $startDate  = $formulario{'startDate'};
    $endDate    = $formulario{'endDate'};

    if($formulario{'country_search'})     { $data = $data->where('id_country',     $formulario{'country_search'});}
    if($formulario{'responsable_search'}) { $data = $data->where('id_responsable', $formulario{'responsable_search'});}
    if($formulario{'id_tp_banco_search'}) { $data = $data->where('id_tp_banco',    $formulario{'id_tp_banco_search'});  }
    if($formulario{'usuario_search'})     { $data = $data->where('usuario_oficina',$formulario{'usuario_search'});}

    if($startDate && $endDate)       { $data = $data
      ->whereBetween('fecha_pago',  [date("Y-m-d", strtotime($startDate) ), date("Y-m-d", strtotime($endDate  ) ) ] ); }

    $data = $data->get();

    return response()->json([
      'data' => $data,
    ]);
  }

  public function getDataGenerales()
  {
    $formulario = request()->formulario;
    $data       = (new VRecargas)->newQuery();
    $startDate  = $formulario{'startDate'};
    $endDate    = $formulario{'endDate'};

    if($formulario{'country_search'})      { $data = $data->where('id_country',     $formulario{'country_search'});}
    if($formulario{'responsable_search'})  { $data = $data->where('id_responsable', $formulario{'responsable_search'});}
    if($formulario{'status_recarga_form'}) { $data = $data->where('id_status_recarga', $formulario{'status_recarga_form'});}
    if($formulario{'status_search'})       {
      if($formulario{'status_search'} == 'null') {
        $data = $data->where('status', null);
      }else{
        $data = $data->where('status', $formulario{'status_search'});
      }
    }
    if($formulario{'id_tp_banco_search'})  { $data = $data->where('id_tp_banco', $formulario{'id_tp_banco_search'});}
    if($formulario{'id_tp_pago_search'})   { $data = $data->where('id_tp_pago',    $formulario{'id_tp_pago_search'});  }

    if($formulario{'usuario_search'})      { $data = $data->where('usuario_oficina',$formulario{'usuario_search'});}

    if($startDate && $endDate)       { $data = $data
      ->whereBetween('fecha_pago',  [date("Y-m-d", strtotime($startDate) ), date("Y-m-d", strtotime($endDate  ) ) ] ); }

    $data = $data->get();

    return response()->json([
      'data' => $data,
    ]);
  }

  public function pendientes()
  {
    $main = new MainClass();
    $main = $main->getMain();

    $valor = $this->validPermisoMenu(18);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

    $pendientesCount = VRecargasPendientes::count();

    $responsable    = User::WHERE('status_user', '=', 'TRUE')->orderBy('username', 'ASC')->pluck('username', 'id');
    $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
    $statusRecarga  = StatusRecarga::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $tppago         = TpPago::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $tpbanco        = TpBanco::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $status         = array('true' => 'APROBADO','false' => 'RECHAZADO', 'null' =>'PENDIENTE');

      return view('recargas.pendientes')
      ->with('pendientesCount',$pendientesCount)
      ->with('status',        $status)
      ->with('responsable',   $responsable)
      ->with('country',       $country)
      ->with('tppago',        $tppago)
      ->with('tpbanco',       $tpbanco)
      ->with('statusRecarga', $statusRecarga)
      ->with('main',          $main);
  }

  public function generales()
  {
    $main = new MainClass();
    $main = $main->getMain();

    $valor = $this->validPermisoMenu(19);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

    $responsable    = User::WHERE('status_user', '=', 'TRUE')->orderBy('username', 'ASC')->pluck('username', 'id');
    $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
    $statusRecarga  = StatusRecarga::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $tppago         = TpPago::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $tpbanco        = TpBanco::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $status         = array('true' => 'APROBADO','false' => 'RECHAZADO', 'null' =>'PENDIENTE');

      return view('recargas.generales')
      ->with('status',        $status)
      ->with('responsable',   $responsable)
      ->with('country',       $country)
      ->with('tppago',        $tppago)
      ->with('tpbanco',       $tpbanco)
      ->with('statusRecarga', $statusRecarga)
      ->with('main',          $main);
  }

  public function updateStatus()
  {
    $id        = request()->id;
    $statusUpd = DriverSaldo::find($id);
    $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
    $statusUpd ->update();
    return response()->json([
      'object' => 'success',
    ]);
  }

  public function sendFormData() {

    $object            = 'success'; $error;
    $formulario        = (object) request()->formulario;
    $id_driver_recarga = $formulario->id_driver_recarga;

    //BUSQUEDA DE TABLAS BASICAS
    $queryDriverRecarga        = DriverRecarga::find($id_driver_recarga);
    $queryDriverRecargaDetalle = DriverRecargaDetalles::where('id_driver_recarga', $id_driver_recarga)->first();
    $queryDriverSaldo          = DriverSaldo::find($queryDriverRecarga->id_driver_saldo);
    $saldo_actual              = $queryDriverSaldo->saldo_actual;
    //BUSQUEDA DE TABLAS BASICAS



    if     ($formulario->status_config == 3){
      //RECHAZADO
      $id_status_recarga = 4;
      $saldo_final       = 0;
      $status            = false;
      $mensaje = 'TRANSACCIÓN RECHAZADA EXITOSAMENTE';
    }
    else if($formulario->status_config == 2){
      //BLOQUEADO
      $id_status_recarga = $formulario->status_config;
      $saldo_final       = 0;
      $status            = null;
      $mensaje           = 'TRANSACCIÓN BLOQUEADA EXITOSAMENTE';

    }
    else{
      //APROBADO
      $id_status_recarga = $formulario->status_config;
      $saldo_final       = $queryDriverSaldo->saldo_actual + $formulario->saldo_recarga_config;
      $status            = true;
      $mensaje = 'EXCELENTE SU  NUEVO SALDO ES: '.$queryDriverSaldo->getcountry->simbolo_local.''.number_format( $saldo_final , 2 );
      $queryDriverSaldo->saldo_actual = $saldo_final;
      $queryDriverSaldo->update();

    }


    try{
      DB::beginTransaction();

      $driverRecarga = [
        'id_tp_pago'        => $formulario->id_tp_pago_config,
        'id_status_recarga' => $id_status_recarga,
        'fecha_pago'        => $formulario->fecha_pago_config,
        'hora_pago'         => $formulario->hora_pago_config,
        'saldo_previo'      => $saldo_actual,
        'saldo_recarga'     => $formulario->saldo_recarga_config,
        'saldo_final'       => $saldo_final,
        'observacion'       => $formulario->observaciones_config,
        'responsable'       => auth()->user()->id,
        'status'            => $status
      ];
      $queryDriverRecarga->update($driverRecarga);

      $driverRecargaDetalle =[
        'id_driver_recarga' => $id_driver_recarga,
        'id_tp_banco'       => $formulario->id_tp_banco_config,
        'num_comprobante'   => $formulario->num_comprobante_config,
        // 'imagen'            => ($formulario->imagen)? $formulario->imagen : null,
        'status'            => $status
      ];
      $queryDriverRecargaDetalle->update($driverRecargaDetalle);



      DB::commit();
    }catch(\Exception $e){
      DB::rollback();
      // dd($e);
      $error   = $e;
      $object  = 'error';
      $mensaje = 'SU RECARGA NO PUDO SER PROCESADA';

    }

    return response()->json([
     'object'    =>   $object,
     'mensaje'   =>  ($object == 'error')? array('error' => $error) : $mensaje,
   ]);


  }

}
