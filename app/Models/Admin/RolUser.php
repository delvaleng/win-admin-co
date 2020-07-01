<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RolUser extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $table      = 'rol_users';
	protected $dates      = ['deleted_at'];

	protected $fillable   = ['role_id','user_id'];

	public function getTpRol()
	{
		return $this->belongsTo(Roles::class, 'role_id');
	}

	public function getUsers()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

}
