<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Roles extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;


	protected $table      = 'roles';

	protected $fillable   = [
		'description',
		'note',
		'modified_by',
		'status_user',
		'status_system',
	];

	protected $casts = [
			'id'          => 'integer',
			'description' => 'string',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'description' => 'required',

	];

}
