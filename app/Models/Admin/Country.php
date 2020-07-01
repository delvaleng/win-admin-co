<?php

namespace App\Models\Admin;

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
      'country_name',
      'area_code',
      'code',
      'national_currency',
      'national_symbol',
      'foreign_currency',
      'foreign_symbol',
      'convert_mount',
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
