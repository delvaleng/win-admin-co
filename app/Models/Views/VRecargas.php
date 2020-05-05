<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VRecargas extends Model
{
  protected $table = 'vw_recargas';
  protected $fillable  = [
    'id_driver_recarga',

    'id_driver_saldo',
    'id_enlace_conductor',
    'id_enlace_app',
    'codigo_oficina',
    'usuario_oficina',

    'saldo_actual',
    'conductor_status',

    'id_counry',
    'country',
    'code_country',
    'moneda_local',
    'moneda_admitida',
    'simbolo_local',
    'simbolo_admitida',
    'conversion_monto',

    'id_tp_pago',
    'tp_pago',

    'id_status_recarga',
    'status_recarga',
    'num_operacion',
    'saldo_previo',
    'saldo_recarga',
    'saldo_final',
    'observacion',

    'status',
    'created_at',
    'updated_at',

    'driver_recarga_detalle',
    'fecha_pago',
    'hora_pago',
    'num_comprobante',
    'imagen',
    'recarga_detalle_observacion',

    'id_tp_banco',
    'tp_banco',

    'id_responsable',
    'responsable'


  ];

  public function getSaldoPrevioAttribute($value){
     return number_format( $value , 2 );
  }
  public function getSaldoRecargaAttribute($value){
     return number_format( $value , 2 );
  }
  public function getSaldoFinalAttribute($value){
     return number_format( $value , 2 );
  }

  public function getStatusAttribute($value){
    if(is_null($value)){
      return 'PENDIENTE';
    }else{
      if ($value == false){ return 'RECHAZADO';}else{ return 'APROBADO'; }
    }
  }




}
