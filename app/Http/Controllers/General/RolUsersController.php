<?php

namespace App\Http\Controllers\General;

// use App\Http\Requests\CreateRolUsersRequest;
use App\Http\Requests\UpdateRolUsersRequest;
use App\Repositories\RolUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Roles;

use App\Models\General\Main;
use App\Classes\MainClass;

use App\User;
use Flash;
use Response;

class RolUsersController extends AppBaseController
{
    /** @var  RolUsersRepository */
    private $rolUsersRepository;

    public function __construct(RolUsersRepository $rolUsersRepo)
    {
        $this->rolUsersRepository = $rolUsersRepo->with('getUsers','getTpRol');
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
     * Display a listing of the RolUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(20);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $rolUsers = $this->rolUsersRepository->all();

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

      $tpUsersAps = User ::orderBy('email', 'ASC')       ->pluck('email', 'id');
      $tpRols     = Roles::WHERE  ('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

        return view('rol_users.create')
        ->with('tpUsersAps', $tpUsersAps)
        ->with('tpRols',     $tpRols)
        ->with('main',       $main);

    }

    /**
     * Store a newly created RolUsers in storage.
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

        $valor = $this->validPermisoMenu(20);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }


        $rolUsers = $this->rolUsersRepository->find($id);
        // $rolUsers = (new RolUsers)->newQuery()->find($id)->with('getUsers','getTpRol');
        // $rolUsers = $rolUsers->get();

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

      $valor = $this->validPermisoMenu(20);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpUsersAps = User ::orderBy('email', 'ASC')     ->pluck('email', 'id');
      $tpRols     = TpRol::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

      $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        return view('rol_users.edit')
        ->with('rolUsers',   $rolUsers)
        ->with('tpUsersAps', $tpUsersAps)
        ->with('tpRols',     $tpRols)
        ->with('main',       $main);

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
        $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        $rolUsers = $this->rolUsersRepository->update($request->all(), $id);

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
        $rolUsers = $this->rolUsersRepository->find($id);

        if (empty($rolUsers)) {
            Flash::error('Rol Usuarios no encontrada');

            return redirect(route('rol-usuarios.index'));
        }

        $this->rolUsersRepository->delete($id);

        Flash::success('Rol Usuarios se eliminó correctamente.');

        return redirect(route('rol-usuarios.index'));
    }

    public function getRolUsers(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new RolUsers)->newQuery()->with('getUsers','getTpRol');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = RolUsers::find($id);
          $statusUpd ->status_user  = ($statusUpd ->status_user == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }

}
