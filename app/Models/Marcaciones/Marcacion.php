<?php

namespace App\Models\Marcaciones;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\User;
use App\Models\Admin\TpMarcacion;
use App\Models\Marcaciones\AutorizacionEmpleado;


/**
 * Class Marcacion
 * @package App\Models
 * @version September 23, 2019, 1:19 am UTC
 *
 * @property integer id_empleado
 * @property integer id_tp_marcacion
 * @property string dia
 * @property time hora_inicio
 * @property time hora_fin
 * @property number total_min
 * @property number latitud
 * @property number longitud
 * @property boolean status
 */
class Marcacion extends Model
{
    use SoftDeletes;

    public $table = 'marcacions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_user',
        'id_tp_marcacion',
        'dia',
        'hora_inicio',
        'hora_fin',
        'total_min',
        'latitud',
        'longitud',
        'observacion',
        'ip_ubicacion',
        'dispositivo',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'id_user'         => 'integer',
        'id_tp_marcacion' => 'integer',
        'dia'             => 'date',
        'total_min'       => 'double',
        'latitud'         => 'string',
        'longitud'        => 'string',
        'status'          => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function empleado()
    {
      return $this->belongsTo(User::class, 'id_user');
    }

    public function tpMarcacion()
    {
      return $this->belongsTo(TpMarcacion::class,     'id_tp_marcacion');
    }

    public function autorizacionEmpleado()
    {
       return $this->hasMany(AutorizacionEmpleado::class);
    }


}
