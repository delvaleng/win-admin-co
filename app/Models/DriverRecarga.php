<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\DriverSaldo;
use App\Models\General\User;
use App\Models\General\TpPago;
use App\Models\General\StatusRecarga;

class DriverRecarga extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'driver_recargas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_driver_saldo',
        'id_tp_pago',
        'id_status_recarga',
        'num_operacion',
        'fecha_pago',
        'hora_pago',
        'saldo_previo',
        'saldo_recarga',
        'saldo_final',
        'observacion',
        'responsable',
        'status'
    ];

    protected $casts = [
    ];

    public static $rules = [

    ];


    public function getDriverSaldo()
    {
      return $this->belongsTo(DriverSaldo::class,     'id_driver_saldo');
    }
    public function getTpPago()
    {
      return $this->belongsTo(DriverSaldo::class,     'id_tp_pago');
    }
    public function getStatusRecarga()
    {
      return $this->belongsTo(StatusRecarga::class,   'id_status_recarga');
    }
    public function getResponsable()
    {
      return $this->belongsTo(User::class,            'responsable');
    }


}
