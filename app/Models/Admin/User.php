<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Admin\Country;
use App\Models\Admin\RolUser;
use App\Models\Admin\Roles;
use App\Models\External\User_office;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;


	protected $table      = 'users';

	protected $dates      = ['deleted_at'];

	protected $fillable   = [
		'username',
		'ndocumento',
		'first_name' ,
		'last_name',
		'phone',
		'email',
		'employe',
		'password' ,
		'country_id',
		'created_by_id',
		'status'
	];

	public function getCountry()    {
		return $this->belongsTo(Country::class,       'country_id');
	}

	public function getModifyBy() {
    return $this->belongsTo(User::class,         'created_by_id');
  }
	public function getRoles()  {
    return $this->hasManyThrough(Roles::class, RolUser::class, 'user_id', 'id', 'id', 'role_id');
  }

}
