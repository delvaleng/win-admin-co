<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Rol_Main extends Model implements Auditable
{

	use \OwenIt\Auditing\Auditable;

	protected $table      = 'rol_main';
	protected $fillable   = ['id_role','id_main'];


	protected $casts = [
			'id'            => 'integer',
			'id_role'       => 'integer',
			'id_main'       => 'integer',
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
			'id_role'     => 'required',
			'id_main'     => 'required',
			// 'modified_by' => 'required'
			// 'note'        => 'required',
	];

	public function getRol()
	{
		return $this->belongsTo(Roles::class, 'id_role');
	}

	public function getMenu()
	{
		return $this->belongsTo(Main::class, 'id_main');
	}

}
