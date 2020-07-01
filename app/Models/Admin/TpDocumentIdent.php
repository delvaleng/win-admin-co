<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\Country;

/**
 * Class TpDocumentoIdentidad
 * @package App\Models
 * @version September 23, 2019, 12:22 am UTC
 *
 * @property string descripcion
 * @property string code
 * @property boolean status
 */
class TpDocumentIdent extends Model
{
    use SoftDeletes;

    public $table = 'tp_document_idents';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'country_id',
        'tp_document_ident_name',
        'code',
        'status'
    ];


    public function getCountry()
  	{
  		return $this->belongsTo(Country::class, 'country_id');
  	}




}
