<?php

namespace App\Models\General;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\General\Departament;
use App\Models\General\City;

class Alcaldia extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'alcaldias';


    protected $dates = ['deleted_at'];


    public $fillable = [
      'id_city',
      'name',
      'status'


    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'id_city' => 'integer',
        'name'    => 'string',
        'status'  => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getCity()
    {
      return $this->belongsTo(City::class,     'id_city');
    }

    public function getDepartamentCity()
    {
     return $this->hasManyThrough(Departament::class, City::class,  'id', 'id', 'id_city', 'id_departament');
    }


}
