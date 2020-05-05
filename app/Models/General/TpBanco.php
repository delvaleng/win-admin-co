<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TpRol
 * @package App\Models
 * @version November 12, 2019, 3:32 pm UTC
 *
 * @property string description
 * @property boolean status
 */
class TpBanco extends Model
{
    use SoftDeletes;

    public    $table = 'tp_bancos';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_tp_cuenta',
        'id_country',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'id_tp_cuenta'=> 'integer',
        'id_country'  => 'integer',
        'description' => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
      'id_tp_cuenta'=> 'required',
      'id_country'  => 'required',
      'description' => 'required',
    ];

    public function getTpCuenta()
    {
      return $this->belongsTo(TpCuenta::class, 'id_tp_cuenta');
    }

    public function getCountry()
    {
      return $this->belongsTo(Country::class, 'id_country');
    }


}
