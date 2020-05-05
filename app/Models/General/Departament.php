<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\General\Country;


/**
 * Class Departament
 * @package App\Models
 * @version August 20, 2019, 8:30 pm UTC
 *
 * @property getCountry
 * @property string departament
 * @property integer id_country
 * @property boolean status
 */
class Departament extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'departaments';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'departament',
        'id_country',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'departament' => 'string',
        'id_country' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function getCountry()
    {
      return $this->belongsTo(Country::class,     'id_country');
    }

}
