<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Main extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $table = 'main';

	protected $dates = ['deleted_at'];


	protected $fillable   = [
		'main_name',
	  'section',
	  'path',
	  'icon',
	  'orden',
	  'status',
	  'user_id',
	];



	protected $casts = [
			'id'            => 'integer',
			'main_name'     => 'string',
			'section'       => 'string',
			'path'          => 'string',
			'icon'          => 'string',
			'orden'         => 'string',
			'status'        => 'boolean',
			'user_id'       => 'integer'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'main_name'   => 'required',
		'section'     => 'required',
		'icon'        => 'required',
		// 'path'         => 'required',
		// 'orden'        => 'required',
		// 'modified_by'  => 'required'

	];
}
