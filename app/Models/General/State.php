<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;



class State extends Model implements Auditable
{
	use SoftDeletes;
	use \OwenIt\Auditing\Auditable;


	protected $table      = 'state';
	protected $fillable   = ['description' , 'id_country','modified_by', 'status_system', 'status_user'];
	public    $timestamps = false;

	public function getStateAddress(){
			return $this->hasMany(Driver::class, 'id');
	}
	public function getState(){
			return $this->hasMany(Customer::class, 'id');
	}

	public static function getStates($id) {
		return State::where('id_country', '=', $id)->get();
	}

	public function cities(){
			return $this->hasMany(City::class, 'id');
	}
	public function country(){
    return $this->belongsTo(Country::class, 'id_country');
  }

}
