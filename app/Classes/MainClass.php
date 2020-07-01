<?php

namespace App\Classes;
use App\Models\Admin\Main;
use Illuminate\Support\Facades\DB;
use Auth;
use View;

class MainClass{


  public  function getMain (){
    if(auth()->user()){
      $id = auth()->user()->id;
      $strMenu = '';
      $strMenu .= '<ul class="sidebar-menu" data-widget="tree" ><li class="header">MEN&Uacute;</li>';
      $strMenu .= $this->cargarMenu(''.$id, '0', '');
      $strMenu .='</ul>';
      return $strMenu;
    }
  }
  public  function getUrl (){
    if(auth()->user()){
      $url = request()->path();
      $url = explode("/",$url);
      $url = $url[0];

      $valor=  Main::where('users.id', '=', auth()->user()->id)
      ->where('main.path', 'like', '/'.$url.'%')
      ->join('rol_main', 'main.id',               '=',   'rol_main.main_id')
      ->join('roles',    'roles.id',              '=',   'rol_main.role_id')
      ->join('rol_users','rol_users.role_id',     '=',   'roles.id')
      ->join('users',    'users.id',              '=',   'rol_users.user_id')
      ->first();

      if($valor != null){
        return true;
      }else{
        return false;
      }

    }
  }

  private function cargarMenu   ($id_user, $id_seccion){
    $strMenu   = '';
    $Menu = $this->getMainByUser($id_user, $id_seccion);
    foreach ($Menu as $main) {
      $name       = $main->main_name;
      $url        = $main->path;
      $icon       = $main->icon;

      $SubMenu = $this->getMainByUser($id_user,  $main->id);
      if ($SubMenu && $url == null){
         $strMenu .= '<li class="treeview"><a href="'.$url.'">'.
                    '<i class="fa '.$icon.'"></i><span>'.$name.'</span>'.
                    '<span class="pull-right-container">'.
                     '<i class="fa fa-angle-left pull-right"></i>'.
                     '</span></a><ul class="treeview-menu">';

                 $strMenu .= $this->cargarMenu($id_user, $main->id);
                 $strMenu .= '</ul></li>';

         }
         else{
           $strMenu .= '<li><a href="'.$url.'"><i class="fa '.$icon.'"></i>'.$name.'</a></li>';
         }
    }
    return $strMenu;
  }

  private function getMainByUser($id_user, $id_seccion){
    return Main::where('users.id', '=', $id_user)
    ->where('section', '=', $id_seccion)
    ->where('main.status', '=', 'TRUE')
    ->join('rol_main', 'main.id',               '=',   'rol_main.main_id')
    ->join('roles',    'roles.id',              '=',   'rol_main.role_id')
    ->join('rol_users','rol_users.role_id',     '=',   'roles.id')
    ->join('users',    'users.id',              '=',   'rol_users.user_id')
    ->select('main.id', 'main.section', 'main.path', 'main.main_name', 'main.icon')
    ->orderby('main.orden', 'asc')
    ->orderby('main.main_name', 'asc')
    ->get();

  }

}
