<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Rol_permissions extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $table      = 'rol_permissions';
  protected $fillable   = ['id_permission','id_roluser','note','modified_by','create_by'];
}
