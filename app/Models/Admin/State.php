<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Admin\Country;


class State extends Model implements Auditable
{

  use SoftDeletes;
  use \OwenIt\Auditing\Auditable;

  public    $table = 'states';
  protected $dates = ['deleted_at'];

	protected $fillable   = [
		'state_name' ,
		'country_id',
		'status',
	];

  public function getCountry()
	{
		return $this->belongsTo(Country::class, 'country_id');
	}


}
