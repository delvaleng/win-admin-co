<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VMenuHojas extends Model
{
  protected $table = 'v_menu_hojas';
  protected $fillable  = ['id', 'seccion', 'url','ramaid', 'ramanombre'];



}
