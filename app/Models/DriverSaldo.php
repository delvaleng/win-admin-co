<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\General\Country;

class DriverSaldo extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'driver_saldo';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_country',
        'id_enlace_conductor',
        'id_enlace_app',
        'codigo_oficina',
        'usuario_oficina',
        'saldo_actual',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function getSaldoActualAttribute($value){
       return number_format( $value , 2 );
    }

    public function getCountry()
    {
      return $this->belongsTo(Country::class,     'id_country');
    }


}
