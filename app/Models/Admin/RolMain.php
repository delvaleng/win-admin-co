<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RolMain extends Model implements Auditable
{

	use \OwenIt\Auditing\Auditable;

	protected $table      = 'rol_main';
	
	protected $dates      = ['deleted_at'];

	protected $fillable   = ['role_id','main_id'];


	protected $casts = [
			'id'            => 'integer',
			'role_id'       => 'integer',
			'main_id'       => 'integer',
			'note'          => 'string',
			'status_system' => 'boolean',
			'status_user'   => 'boolean',
			'modified_by'   => 'integer'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
			'role_id'     => 'required',
			'main_id'     => 'required',
			// 'modified_by' => 'required'
			// 'note'        => 'required',
	];

	public function getRol()
	{
		return $this->belongsTo(Roles::class, 'role_id');
	}

	public function getMenu()
	{
		return $this->belongsTo(Main::class, 'main_id');
	}

}
