<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Marcaciones\Marcacion;

/**
 * Class TpMarcacion
 * @package App\Models
 * @version September 22, 2019, 11:46 pm UTC
 *
 * @property string descripcion
 * @property boolean status
 */
class TpMarcacion extends Model
{
    use SoftDeletes;

    public $table = 'tp_marcacions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function marcacion()
    {
       return $this->hasMany(Marcacion::class);
    }

}
