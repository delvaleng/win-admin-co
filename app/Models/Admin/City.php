<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Admin\State;
use App\Models\Admin\Country;

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
        'city_name',
        'state_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'city'     => 'string',
        'state_id' => 'integer',
        'status'   => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getState()
    {
      return $this->belongsTo(State::class,     'state_id');
    }

    public function getStateCountry()
    {
     return $this->hasManyThrough(Country::class, State::class, 'id','id', 'state_id', 'country_id');
   }


}
