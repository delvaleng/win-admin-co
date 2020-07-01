<?php

namespace App\Models\Marcaciones;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Marcaciones\HorarioUser;
use App\Models\Admin\User;


/**
 * Class Horario
 * @package App\Models
 * @version November 26, 2019, 7:53 am -05
 *
 * @property string dia
 * @property time entrada
 * @property time salida
 * @property boolean status
 */
class Horario extends Model
{
    use SoftDeletes;

    public $table = 'horarios';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_horario_user',
        'dia',
        'entrada',
        'salida',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'dia'    => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function horarioEmpleado()
    {
      return $this->hasManyThrough(User::class, HorarioUser::class, 'id','id', 'id_horario_user', 'id_user');
    }


}
