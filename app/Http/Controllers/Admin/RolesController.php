<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Roles;

use App\Models\Admin\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class RolesController extends AppBaseController
{
    private $menuid = 4;

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
     * Display a listing of the TpRol.
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

      $tpRols = Roles::all();

      return view('roles.index')
          ->with('tpRols', $tpRols)
          ->with('main',   $main);

    }

    /**
     * Show the form for creating a new TpRol.
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

        return view('roles.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created
     *
     * @param CreateRoles
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();

        $validator = Validator::make($input, [
          'role_name' => 'required|unique:roles',
        ]);

        if ($validator->fails()) {
          return redirect(route('roles.create'))
            ->withErrors($validator)
            ->withInput();
        }

        $tpRol = Roles::create($input);

        Flash::success('Rol guardado con éxito.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified TpRol.
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

        $tpRol = Roles::find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');
            return redirect(route('roles.index'));
        }

        return view('roles.show')
        ->with('tpRol',  $tpRol)
        ->with('main',   $main);
    }

    /**
     * Show the form for editing the specified TpRol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }


        $tpRol = Roles::find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');
            return redirect(route('roles.index'));
        }

        return view('roles.edit')
        ->with('tpRol', $tpRol)
        ->with('main',  $main);
    }

    /**
     * Update the specified TpRol in storage.
     *
     * @param int $id
     * @param UpdateRolesRequest $request
     *
     * @return Response
     */
    public function update($id)
    {
        $tpRol = Roles::find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }
        $input = request()->all();
        // $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

            'role_name' => 'required|unique:roles,role_name,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('roles.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpRol = $tpRol->update($input);

        Flash::success('Rol se actualizó con éxito.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified TpRol from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpRol = Roles::find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }

        $this->rolesRepository->delete($id);

        Flash::success('Rol eliminado con éxito');

        return redirect(route('roles.index'));
    }
    public function getTpRols(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Roles)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = Roles::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
