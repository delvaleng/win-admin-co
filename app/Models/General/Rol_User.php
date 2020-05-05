<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Rol_User extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $table      = 'rol_user';
	protected $fillable   = ['id_role','id_user'];


}
