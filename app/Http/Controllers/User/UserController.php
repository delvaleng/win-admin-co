<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin\RolPermissions;
use App\Models\Admin\Permission;
use App\Models\Admin\RolUser;
use App\Models\Admin\Roles;
use App\Models\Admin\Main;
use App\Models\Admin\User;

use App\Models\Admin\Country;
use App\Models\Views\VMenuRoles;

use App\Classes\MainClass;
use \stdClass;
use Flash;
use Auth;


class UserController extends Controller
{
  private $menuid = 8;

  public function __construct(){

    $this->middleware('auth');
  }

  public function validPermisoMenu() {
    $roles = RolUser::where('user_id', auth()->user()->id)->get();
    foreach ($roles as $key) {
      if($key->role_id == 1){
        return true;
      }
      else{
        $menu = RolMain::where('role_id', $key->role_id)
        ->where('main_id', $this->menuid)->first();
        if($menu){
          return true;
        }
      }
    }
    return false;
  }

  public function UserPermisos(){

    $a = new stdClass();
    $a->view     = false;
    $a->create   = false;
    $a->edit     = false;
    $a->delete   = false;
    $a->rol      = false;
	  $a->password = false;

    return $a;
  }

  public function index(){

    $main = new MainClass();
    $main = $main->getMain();

    $roles    = Roles     ::WHERE('status', '=', 'TRUE')->orderBy('role_name', 'ASC')->pluck('role_name', 'id');
    $users    = User      ::WHERE('status', '=', 'TRUE')->with('getCountry', 'getModifyBy')->orderBy('username', 'asc')->get();
    $permisos = Permission::WHERE('status', '=', 'TRUE')->pluck('permission_name', 'id');

    $valor = $this->validPermisoMenu();
    if ($valor == false){
      return view('errors.403', compact('main'));
    }
    return view('user.index',compact('users', 'main', 'roles','permisos'));
  }

  public function create(){

    $main    = new MainClass();
    $main    = $main->getMain();

    $roles    = Roles     ::WHERE('status', '=', 'TRUE')->orderBy('role_name', 'ASC')->pluck('role_name', 'id');
    $users    = User      ::WHERE('status', '=', 'TRUE')->with('getCountry', 'getModifyBy')->orderBy('username', 'asc')->get();
    $permisos = Permission::WHERE('status', '=', 'TRUE')->pluck('permission_name', 'id');


    $country = Country::WHERE('status', '=', 'TRUE')->orderBy('country_name', 'ASC')->pluck('country_name', 'id');

    $t = $this->PermisosUser();
    $permisocrear = $t->create;
    $rolid = $t->rolid;

    if ($permisocrear == true || $rolid == 1){
      return view('user.create', compact('main', 'roles', 'country'));
    }else{
      return view('errors.403', compact('main'));
    }

  }

  public function store (){
    try{
      DB::beginTransaction();
      $data =[
        'username'     => mb_strtolower(request()->username),
        'ndocumento'   => request()->ndocumento,
        'first_name'   => mb_strtoupper(request()->first_name),
        'last_name'    => mb_strtoupper(request()->last_name),
        'phone'        => request()->phone,
        'email'        => mb_strtolower(request()->email),
        'employe'      => request()->employe,
        'birthdate'    => request()->birthdate,
        'password'     => Hash::make(request()->password),
        'country_id'   => request()->cod_country,
        'created_by_id'=> auth()->user()->id,

      ];

      $id_user = User::create($data)->id;
      $roles   = request()->id_rol;
      foreach ($roles as $r) {
        $userRole =[
          'role_id'        => $r,
          'user_id'        => $id_user,
        ];
        RolUser::create($userRole);

    }

      DB::commit();
     }catch(\Exception $e){
          DB::rollback();
          Flash::error('Su usuario no puedo ser registrado.');
          return  redirect()->route('user.index');

          // dd($e);

      }
      Flash::success('Usuario guardado con éxito.');

      return  redirect()->route('user.index');
  }

  public function getUsers(){

    $users = [];
    $t     = $this->PermisosUser();

    $usersQuery = User::with('getCountry', 'getModifyBy')
    ->orderBy('created_at', 'asc')
    ->get();

    foreach ($usersQuery as $r) {
        $status  = ($r->status === TRUE)? "FALSE" : "TRUE";
        $titleSt = ($r->status === TRUE)? 'Activo' : 'Inactivo';
        $iconSt  = ($r->status === TRUE)? 'fa-check-square-o' : 'fa-close';

        $action  = ($t->view == true || $t->rolid == 1) ?
                    '<a data-toggle="modal" data-target="#modal-show" class="btn-modalShow" data-id="'.$r->id.'"><i class="fa fa-eye" title="Ver Usuario"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;' : '';

        $action  .= ($t->rol == true || $t->rolid == 1) ?
                    '<a data-toggle="modal" data-target="#modal-rol" class="btn-modalRol" data-id="'.$r->id.'"><i class="fa fa-cogs" title="Ver Roles"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;' : '';

        $action  .= ($t->view == true || $t->rolid == 1)?
                    '<a data-toggle="modal" data-target="#modal-permisos" class="btn-modalPermisos" data-id="'.$r->id.'"><i class="fa fa-unlock-alt" title="Asignar Permisos"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;' : '';


        $action  .= ($t->password == true || $t->rolid == 1)?
                    '<a data-toggle="modal" data-target="#modal-passw" class="btn-modalPass" data-id="'.$r->id.'"><i class="fa fa-key" title="Cambiar Password"></i></a>' : '';

        $status = ($t->delete == true || $t->rolid == 1)?
                  '<a status="'.$status.'"  data-id="'.$r->id.'" id="status"><i class="fa '.$iconSt.'" title='.$titleSt.'></i></a>' : '';

        $user   = [
          'action'       => $action,
          'username'     => $r->username,
          'name'         => $r->first_name.' '.$r->last_name,
          'ndocumento'   => ($r->ndocumento)? $r->ndocumento : '-',
          'phone'        => $r->phone,
          'email'        => $r->email,
          'id_country'   => ($r->country_id   )?  $r->getCountry->country_name  : '',
          'usermodifyby' => ($r->created_by_id)?  $r->getModifyBy->username     : '-',
          'status'       => $status
        ];
        array_push($users, $user);
      }


    return response()->json([
      'data' => $users,
    ]);

  }

  public function userDetails(){
    if (request()->ajax( )){
        $user = User::where('status', '=', 'TRUE')
        ->where('id', '=', request()->id)
        ->with('getCountry', 'getModifyBy', 'getRoles')
        ->orderBy('created_at', 'asc')
        ->first();

        return response()->json([
          'id'   => request()->id,
          'user' => $user,
        ]);
      }
  }

  public function rolDetails(){

    if (request()->ajax( )){

      $rol_user =  RolUser::where('rol_users.user_id', '=', request()->id)
         ->join('v_menu_roles', 'v_menu_roles.role_id', '=', 'rol_users.role_id')
         ->join('main', 'main.id', '=', 'v_menu_roles.id')
         ->select('main.main_name as main', 'v_menu_roles.ramanombre','v_menu_roles.id',  'v_menu_roles.role_id','v_menu_roles.role_name as rol')
         ->get();

      return response()->json([
          "id"       => request()->id,
          "rol_user" => $rol_user
        ]);
      }
  }

  public function PermisosDetails(){

    if (request()->ajax( )){



      $rol = Main::where('users.id', '=', request()->id)
        ->where('main.status', '=', 'TRUE')
        ->join('rol_main', 'main.id',               '=',   'rol_main.id_main')
        ->join('roles',    'roles.id',              '=',   'rol_main.role_id')
        ->join('RolUser', 'RolUser.role_id',      '=',   'roles.id')
        ->join('users',    'users.id',              '=',   'RolUser.id_user')
        ->select('roles.id','RolUser.id as id_roluser')
        ->first();

      $roluser = $rol{'id_roluser'};

      $permissions = Rol_permissions::where('id_roluser', '=', $roluser)
                    ->select('id_permission')
                    ->get();

      return response()->json([
          "id"       => request()->id,
          "permisos_user" => $permissions,
          "id_roluser" => $roluser
        ]);
      }
  }

  public function rolDetailsSelect(){

    if (request()->ajax( )){
      $rol =  VMenuRoles::where('role_id', '=', request()->id)
         ->join('main', 'main.id', '=', 'v_menu_roles.id')
         ->select('main.main_name as main', 'v_menu_roles.ramanombre',
         'v_menu_roles.id',  'v_menu_roles.role_id','v_menu_roles.role_name as rol')
         ->get();

      return response()->json([
          "id"       => request()->id,
          "rol" => $rol
        ]);
      }
  }

  public function updateRolUser(){
    $error = null;
    if (request()->ajax( )){
      try{
        DB::beginTransaction();

        $roles    = request()->id_rol;
        $id_user  = request()->id_user;

        $rol = Main::where('users.id', '=', $id_user)
          ->where('main.status', '=', 'TRUE')
          ->join('rol_main', 'main.id',               '=',   'rol_main.main_id')
          ->join('roles',    'roles.id',              '=',   'rol_main.role_id')
          ->join('rol_users',  'rol_users.role_id',   '=',   'roles.id')
          ->join('users',    'users.id',              '=',   'rol_users.user_id')
          ->select('roles.id','rol_users.id as id_roluser')
          ->first();
        $roluser = $rol{'id_roluser'};

        $permissions = Rol_permissions::where('id_roluser', '=', $roluser);
        $permissions->delete();

        $RolUser = RolUser::where('user_id', '=', $id_user);
        $RolUser->delete();

        foreach ($roles as $r) {
          $userRole =[
            'role_id'        => $r,
            'user_id'        => $id_user,
          ];
          RolUser::create($userRole);
        }

        DB::commit();
       }catch(\Exception $e){
         $error =$e; DB::rollback(); }


      return response()->json([
          "mensaje"       => 'Actualizacion de roles ejecutada de forma satisfactoria',
          "error"         => $error
        ]);
      }
  }

  public function updatePermisoUser(){
    if (request()->ajax( )){
      try{
        DB::beginTransaction();

        $Permisos = request()->id_permisos;
        $RolUser  = request()->id_roluserp;
        $permisos_User = Rol_permissions::where('id_roluser', '=', $RolUser);
        $permisos_User->delete();

        foreach ($Permisos as $r) {
          $userPermisos =[
            'id_permission'     => $r,
            'id_roluser'        => $RolUser,
          ];
          Rol_permissions::create($userPermisos);
        }

        DB::commit();
       }catch(\Exception $e){  DB::rollback(); }


      return response()->json([
          "mensaje"       => 'Actualizacion de permisos ejecutada de forma satisfactoria',
        ]);
      }
  }

  public function validUser(){
    $valor =  User::where('username', request()->username)
      ->count();
    return $valor;
  }

  public function validUserDni(){
    $valor =  User::where('ndocumento', request()->ndocumento)
      ->count();
    return $valor;
  }

  public function updatePassword(){
    if (request()->ajax( )){
      $user = User::findOrFail(request()->id_user);

      try{
        DB::beginTransaction();

          $user->password = Hash::make(request()->password);
          $user->save();

        DB::commit();
      }catch(\Exception $e){  DB::rollback(); }


      return response()->json([
          "mensaje"       => 'Actualizacion'
        ]);
      }
  }

  public function updateStatus(){
    if (request()->ajax( )){
      $user = User::findOrFail(request()->id);
      try{
        DB::beginTransaction();
          $user->status = request()->status;
          $user->save();
        DB::commit();
      }catch(\Exception $e){  DB::rollback(); }
      $mensaje;
      if (request()->status == 'FALSE'){
        $mensaje = 'El usuario '.$user->username.' ha sido desactivado de forma satisfactoria';
      }else{
        $mensaje = 'El usuario '.$user->username.' ha sido activado de forma satisfactoria';
      }

      return response()->json([
          "mensaje"       => $mensaje
        ]);
      }
  }

  //permisosUsers
  public function PermisosUser(){

    $rol = Main::where('users.id', '=', auth()->user()->id)
      ->where('main.status', '=', 'TRUE')
      ->join('rol_main',   'main.id',               '=',   'rol_main.main_id')
      ->join('roles',      'roles.id',              '=',   'rol_main.role_id')
      ->join('rol_users',  'rol_users.role_id',     '=',   'roles.id')
      ->join('users',      'users.id',              '=',   'rol_users.user_id')
      ->select('roles.id','rol_users.id as rol_user_id')
      ->first();

    $roluser = $rol{'rol_user_id'};

    $t = $this->UserPermisos();

    $permissions = RolPermissions::where('rol_user_id', '=', $roluser)
                  ->select('permission_id')
                  ->get();

    foreach ($permissions as $rs) {
      if ($rs->permission_id == 3){
         $t->create = true;
      }else if ($rs->permission_id == 5){
         $t->view = true;
      }else if ($rs->permission_id == 3){
         $t->edit = true;
      }else if ($rs->permission_id == 4){
         $t->delete = true;
      }else if ($rs->permission_id == 6){
         $t->reporte = true;
      }else if ($rs->permission_id == 7){
         $t->rol = true;
      }else if ($rs->permission_id == 8){
         $t->password = true;
      }
    }

    $t->rolid = $rol{'id'};

    return $t;
  }

  public function getRolValid()
  {
    $externo = RolUser::where('id_user', auth()->user()->id)->where('role_id', 7);
    if (RolUser::where('id_user', auth()->user()->id)->where('role_id', 7)->exists()){
      return 'true';
    }
    return 'false';
  }

  public function miperfil(){


    $main = new MainClass();
    $main = $main->getMain();

    $user = User::find(auth()->user()->id );
    return view('user.perfil')
    ->with('user', $user)
    ->with('main', $main);

  }

  public function changePassword()
  {
    $main = new MainClass();
    $main = $main->getMain();

    return view('user.cambiarPassword')
    ->with('main', $main);

  }

  public function savePassword()
  {

    $input = request()->all();

    try{
      DB::beginTransaction();
      $dataUser =  [
        'password'          => Hash::make($input{'password'}),
      ];
      $user = User::find(auth()->user()->id );
      $user->update($dataUser);

      DB::commit();
      }catch(\Exception $e){
        DB::rollback();
        return  redirect('/');
      }
      Auth::logout();
      return redirect('/')->with('error_message', 'Session Finalizada');
  }

}
