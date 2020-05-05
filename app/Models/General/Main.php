<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Main extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $table      = 'main';

	protected $fillable   = [
		'description',
	  'section',
	  'path',
	  'icon',
	  'orden',
	  'status_system',
	  'status_user',
	  'modified_by'
	];



	protected $casts = [
			'id'            => 'integer',
			'description'   => 'string',
			'section'       => 'string',
			'path'          => 'string',
			'icon'          => 'string',
			'orden'         => 'string',
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
		'description' => 'required',
		'section'     => 'required',
		'icon'        => 'required',
		// 'path'         => 'required',
		// 'orden'        => 'required',
		// 'modified_by'  => 'required'

	];
}
