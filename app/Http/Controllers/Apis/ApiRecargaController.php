<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\General\Country;
use App\Models\DriverSaldo;
use App\Models\DriverRecarga;
use App\Models\DriverRecargaDetalles;
use App\Models\Views\VRecargas;


class ApiRecargaController extends Controller
{

    public function insertRecarga()  {

      $mensaje = '';
      $object  = 'success';
      $error;

      $formulario = (object) request()->all();

      try{
        DB::beginTransaction();

        $numOperacion = $this->getNumOperacion();
        $numOperacion = date('Ymd').'-'.str_pad($numOperacion, 4, "0", STR_PAD_LEFT);
        $querySaldo   = DriverSaldo::find( $formulario->id_driver_saldo );

        if(!$querySaldo){
          return response()->json([
           'object'    =>   'error',
           'mensaje'   =>  'NO HEMOS IDENTIFICADO EL USUARIO QUE DESEA RECARGAR.',
          ]);
        }

        $saldo_actual = $querySaldo->saldo_actual;

        $driverRecarga = [
          'id_driver_saldo'   => $formulario->id_driver_saldo,
          'id_tp_pago'        => $formulario->id_tp_pago,
          'fecha_pago'        => ($formulario->fecha_pago)? $formulario->fecha_pago : date('Y-m-d') ,
          'hora_pago'         => ($formulario->hora_pago )? $formulario->hora_pago  : date("H:i:s"),
          'saldo_previo'      => $saldo_actual,
          'saldo_recarga'     => $formulario->saldo_recarga,
          'num_operacion'     => $numOperacion,
        ];
        $queryDriverRecarga = DriverRecarga::where('num_operacion', $numOperacion)->first();
        if(!$queryDriverRecarga){

        $driverRecarga{'id_status_recarga'}  = ($formulario->id_tp_pago  == 1 || $formulario->id_tp_pago  == 2)?  1 : 4;

        $id_driver_recarga = DriverRecarga::create($driverRecarga)->id;

        $driverRecargaDetalle =[
          'id_driver_recarga' => $id_driver_recarga,
          'id_tp_banco'       => ($formulario->id_tp_pago  == 3)? 1 : $formulario->id_tp_banco,
          'num_comprobante'   => $formulario->num_comprobante,
          'imagen'            => ($formulario->imagen)? $formulario->imagen : null,
          'observacion'       => $formulario->observacion_detalle,
        ];

        DriverRecargaDetalles::create($driverRecargaDetalle);

        if ($formulario->id_tp_pago == 3){
          $newSaldo  = $querySaldo->saldo_actual  + $formulario->saldo_recarga;
          $querySaldo->saldo_actual = $newSaldo;
          //TRUE ESTATUS DEL CONDUSTOR API
          $querySaldo->update();


          $queryDriverRecarga = DriverRecarga::find($id_driver_recarga);
          $queryDriverRecarga->saldo_final = $newSaldo;
          $queryDriverRecarga->status      = true;
          $queryDriverRecarga->update();
          $mensaje = 'EXCELENTE SU  NUEVO SALDO ES: '.$querySaldo->getcountry->simbolo_local.''.number_format( $newSaldo , 2 );

        }else{
          $mensaje = 'SU RECARGA DE:'.$querySaldo->getcountry->simbolo_local.''.number_format( $formulario->saldo_recarga , 2 ).' SERA GESTIONADA';
        }

      }

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

    public function getNumOperacion(){
      $now = new \DateTime();
      $fecha = $now->format('Y')."-".$now->format('m')."-".$now->format('d');
      $fi    = $fecha." 00:00:00.0000-05";
      $ff    = $fecha." 23:59:59.0000-05";
       return DriverRecarga::whereBetween('created_at', [$fi, $ff])->count()+1;
    }

    public function getRecargasLast() {

      $object  = 'success';

      $id_driver_saldo = request()->id_driver_saldo;

      $queryRecargas   = VRecargas::where('id_driver_saldo', $id_driver_saldo )
      ->select('fecha_pago', 'hora_pago', 'num_operacion', 'tp_pago', 'saldo_recarga','status', 'simbolo_local', 'created_at')
      ->orderBy('created_at','desc')
      ->take(20)
      ->get();

      if(!$queryRecargas){
        $object  = 'error';
      }

      return response()->json([
       'object'    =>   $object,
       'data'      =>   $queryRecargas,
      ]);
    }

    public function getRecargasDate() {

      $object  = 'success';

      $id_driver_saldo = request()->id_driver_saldo;
      $fecha_pago      = request()->fecha_pago;


      $queryRecargas   = VRecargas::where('id_driver_saldo', $id_driver_saldo )
      ->where('fecha_pago', $fecha_pago )
      ->select('fecha_pago', 'hora_pago', 'num_operacion', 'tp_pago', 'saldo_recarga','status', 'simbolo_local', 'created_at')
      ->orderBy('created_at','desc')
      ->take(20)
      ->get();

      if(!$queryRecargas){
        $object  = 'error';
      }

      return response()->json([
       'object'    =>   $object,
       'data'      =>   $queryRecargas,
      ]);
    }


}
