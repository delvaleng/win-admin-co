<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TpCuenta extends Model
{
    use SoftDeletes;

    public    $table = 'tp_cuentas';

    protected $dates = ['deleted_at'];



    public $fillable = [
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
        'description' => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
      'description' => 'required',

    ];


}
