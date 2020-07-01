<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class  VMenuRoles extends Model
{
  protected $table = 'v_menu_roles';
  protected $fillable  = ['id', 'seccion', 'url','ramaid', 'ramanombre', 'role_id', 'role_name', 'rol_main_id'];



}
