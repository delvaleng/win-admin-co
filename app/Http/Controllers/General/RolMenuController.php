<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateRolMenuRequest;
use App\Http\Requests\UpdateRolMenuRequest;
use App\Repositories\RolMenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Roles;

use App\Models\General\Main;
use App\Classes\MainClass;

use Flash;
use Response;

class RolMenuController extends AppBaseController
{
    /** @var  RolMenuRepository */
    private $rolMenuRepository;

    public function __construct(RolMenuRepository $rolMenuRepo)
    {
        $this->rolMenuRepository = $rolMenuRepo;
    }

    public function validPermisoMenu($id_menu) {

      $roles = Rol_User::where('id_user', auth()->user()->id)->get();
      foreach ($roles as $key) {
        if($key->id_role == 2){
          return true;
        }
        else{
          $menu = Rol_Main::where('id_role', $key->id_role)->where('id_main', $id_menu)->first();

          if($menu){
            return true;
          }
        }
      }
      return false;

    }

    /**
     * Display a listing of the Rol_Main.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(8);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMenus = $this->rolMenuRepository->all();

        return view('rol_menus.index')
            ->with('rolMenus', $rolMenus)
            ->with('main',     $main);

    }

    /**
     * Show the form for creating a new Rol_Main.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $rols  = Roles::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
      $menu  = Main ::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');

        return view('rol_menus.create')
        ->with('rols', $rols)
        ->with('main', $main)
        ->with('menu', $menu);

    }

    /**
     * Store a newly created Rol_Main in storage.
     *
     * @param CreateRolMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateRolMenuRequest $request)
    {
        $input = $request->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        $rolMenu = $this->rolMenuRepository->create($input);

        Flash::success('Rol Menú guardado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Display the specified Rol_Main.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(8);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolMenu = $this->rolMenuRepository->find($id);

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        return view('rol_menus.show')
        ->with('rolMenu', $rolMenu)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified Rol_Main.
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

        $rolMenu = $this->rolMenuRepository->find($id);

        $rols  = Roles::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
        $menu  = Main ::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        return view('rol_menus.edit')
        ->with('rolMenu', $rolMenu)
        ->with('rols',    $rols)
        ->with('main',    $main)
        ->with('menu',    $menu);
    }

    /**
     * Update the specified Rol_Main in storage.
     *
     * @param int $id
     * @param UpdateRol_MainRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRol_MainRequest $request)
    {
        $rolMenu = $this->rolMenuRepository->find($id);

        $input = $request->all();
        $input{'note'} = mb_strtoupper($input{'note'});

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        $rolMenu = $this->rolMenuRepository->update($input, $id);

        Flash::success('Rol Menu actualizado con éxito.');

        return redirect(route('rol-menus.index'));
    }

    /**
     * Remove the specified Rol_Main from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rolMenu = $this->rolMenuRepository->find($id);

        if (empty($rolMenu)) {
            Flash::error('Rol Menú no encontrado');

            return redirect(route('rol-menus.index'));
        }

        $this->rolMenuRepository->delete($id);

        Flash::success('Rol Menú eliminado con éxito.');

        return redirect(route('rol-menus.index'));
    }
    public function getRolMain(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Rol_Main)->newQuery()->with('getRol','getMenu');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = Rol_Main::find($id);
      $statusUpd ->status_user  = ($statusUpd ->status_user == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
