<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Views\VMenuRoles;
use App\Models\Views\VMenuHojas;
use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Roles;
use App\Models\Admin\Main;
use App\Classes\MainClass;


use Flash;
use Response;

class RolMenuController extends AppBaseController
{
  private $menuid = 5;

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
     * Display a listing of the RolMain.
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

        $RolMains = RolMain::all();

        return view('rol_menus.index')
            ->with('RolMains', $RolMains)
            ->with('main',     $main);

    }

    /**
     * Show the form for creating a new RolMain.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $rols  = Roles::WHERE('status', '=', 'TRUE')->orderBy('role_name', 'ASC')->pluck('role_name', 'id');
      // $menu  = VMenuHojas::WHERE('status', '=', 'TRUE')->orderBy('main_name', 'ASC')->pluck('main_name', 'id');
      $menu  = VMenuHojas::orderBy('ramanombre', 'ASC')->pluck('ramanombre', 'id');


        return view('rol_menus.create')
        ->with('rols', $rols)
        ->with('main', $main)
        ->with('menu', $menu);

    }

    /**
     * Store a newly created RolMain in storage.
     *
     * @param CreateRolMainRequest $request
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        $RolMain = RolMain::create($input);

        Flash::success('Rol Menú guardado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Display the specified RolMain.
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

        $rolMain = RolMain::find($id);

        if (empty($rolMain)) {
            Flash::error('Rol Menú no encontrado');
            return redirect(route('rol-menus.index'));
        }

        return view('rol_menus.show')
        ->with('rolMain', $rolMain)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified RolMain.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(8);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMain = RolMain::find($id);

        $rols  = Roles::WHERE('status', '=', 'TRUE')->orderBy('role_name', 'ASC')->pluck('role_name', 'id');
        $menu  = Main ::WHERE('status', '=', 'TRUE')->orderBy('main_name', 'ASC')->pluck('main_name', 'id');

        if (empty($rolMain)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        return view('rol_menus.edit')
        ->with('rolMenu', $rolMain)
        ->with('rols',    $rols)
        ->with('main',    $main)
        ->with('menu',    $menu);
    }

    /**
     * Update the specified RolMain in storage.
     *
     * @param int $id
     * @param UpdateRolMainRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRolMainRequest $request)
    {
        $RolMain = RolMain::find($id);

        $input = request()->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        if (empty($RolMain)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        $RolMain = RolMain::update($input, $id);

        Flash::success('Rol Menu actualizado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Remove the specified RolMain from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $RolMain = RolMain::find($id);

        if (empty($RolMain)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        RolMain::delete($id);

        Flash::success('Rol Menú eliminado con éxito.');

        return redirect(route('rol-menus.index'));
    }
    public function getRolMain(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new RolMain)->newQuery()->with('getRol','getMenu');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = RolMain::find($id);
      $statusUpd ->status_user  = ($statusUpd ->status_user == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
