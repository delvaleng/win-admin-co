<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model implements Auditable
{

  use SoftDeletes;
  use \OwenIt\Auditing\Auditable;


  protected $table = 'permissions';

  protected $dates = ['deleted_at'];


  protected $fillable   = [
    'id',
    'permission_name',
    'status',
    'user_id',
  ];

}
