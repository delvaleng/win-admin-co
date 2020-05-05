<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Country
 * @package App\Models
 * @version August 20, 2019, 8:27 pm UTC
 *
 * @property string country
 * @property boolean status
 */
class Country extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;



    public $table = 'countries';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'country',
        'code',
        'moneda_local',
        'moneda_admitida',
        'simbolo_local',
        'simbolo_admitida',
        'conversion_monto',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts  = [
        'id' => 'integer',
        'country' => 'string',
        'status' => 'boolean'
    ];



    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

}
