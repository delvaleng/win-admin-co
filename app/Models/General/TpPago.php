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
class TpPago extends Model
{
    use SoftDeletes;

    public    $table = 'tp_pagos';

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
