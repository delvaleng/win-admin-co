<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RolPermissions extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $table      = 'rol_permissions';
  protected $dates      = ['deleted_at'];


  protected $fillable   = [
    'permission_id',
    'rol_user_id',
    'note',
    'modified_by',
    'create_by'
  ];

}
