<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\DriverSaldo;
use App\Models\General\TpBanco;

class DriverRecargaDetalles extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'driver_recarga_detalles';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_driver_recarga',
        'id_tp_banco',
        'num_comprobante',
        'imagen',
        'observacion',
        'status'
    ];

    protected $casts = [
    ];

    public static $rules = [

    ];


    public function getTpBanco()
    {
      return $this->belongsTo(TpBanco::class,     'id_tp_banco');
    }

}
