<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Roles;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use App\User;
use Flash;
use Response;

class RolUsersController extends AppBaseController
{

  private $menuid = 6;

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

    /**
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $rolUsers = RolUser::all();

      return view('rol_users.index')
          ->with('rolUsers', $rolUsers)
          ->with('main',     $main);

    }

    /**
     * Show the form for creating a new RolUsers.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpUsersAps = User ::orderBy('email', 'ASC')       ->pluck('email', 'id');
      $tpRols     = Roles::WHERE  ('status', '=', 'TRUE')->orderBy('role_name', 'ASC')->pluck('role_name', 'id');

        return view('rol_users.create')
        ->with('tpUsersAps', $tpUsersAps)
        ->with('tpRols',     $tpRols)
        ->with('main',       $main);

    }

    /**
     *
     * @param CreateRolUsersRequest $request
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();

        $rolUsers = RolUsers::create($input);

        Flash::success('Rol Usuarios se ha guardado correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    /**
     * Display the specified RolUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $rolUsers = RolUser::find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');
            return redirect(route('rol-usuarios.index'));
        }

        return view('rol_users.show')
        ->with('rolUsers', $rolUsers)
        ->with('main',     $main);

    }

    /**
     * Show the form for editing the specified RolUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      return view('errors.403', compact('main'));
    }

    /**
     * Update the specified RolUsers in storage.
     *
     * @param int $id
     * @param UpdateRolUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRolUsersRequest $request)
    {
        $rolUsers = RolUser::find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        $rolUsers = RolUser::update($request->all(), $id);

        Flash::success('Rol Usuarios se actualizó correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    /**
     * Remove the specified RolUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rolUsers = RolUser::find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        RolUser::delete($id);

        Flash::success('Rol Usuarios se eliminó correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    public function getRolUsers(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new RolUser)->newQuery()->with('getUsers','getTpRol');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = RolUser::find($id);
          $statusUpd ->status_user  = ($statusUpd ->status_user == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }

}
