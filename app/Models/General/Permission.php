<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $table      = 'permissions';
  protected $fillable   = ['id','description','note','modified_by','create_by'];
  
}
