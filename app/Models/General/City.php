<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\General\Departament;
use App\Models\General\Country;

/**
 * Class City
 * @package App\Models
 * @version August 20, 2019, 9:45 pm UTC
 *
 * @property getDepartament
 * @property string city
 * @property integer id_departament
 * @property boolean status
 */
class City extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'cities';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'city',
        'id_departament',
        'status'


    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'city' => 'string',
        'id_departament' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getDepartament()
    {
      return $this->belongsTo(Departament::class,     'id_departament');
    }

    public function getDepartamentCountry()
    {
     return $this->hasManyThrough(Country::class, Departament::class, 'id','id', 'id_departament', 'id_country');
   }


}
