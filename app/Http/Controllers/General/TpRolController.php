<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateTpRolRequest;
use App\Http\Requests\UpdateTpRolRequest;
use App\Repositories\TpRolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Roles;

use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpRolController extends AppBaseController
{
    /** @var  TpRolRepository */
    private $tpRolRepository;
    private $menu;


    public function __construct(TpRolRepository $tpRolRepo)
    {
        $this->tpRolRepository = $tpRolRepo;
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
     * Display a listing of the TpRol.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(9);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRols = $this->tpRolRepository->all();

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

        return view('roles.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created TpRol in storage.
     *
     * @param CreateTpRolRequest $request
     *
     * @return Response
     */
    public function store(CreateTpRolRequest $request)
    {
        $input = $request->all();
        // $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

          'description' => 'required|unique:roles',
        ]);

        if ($validator->fails()) {

            return redirect(route('roles.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $tpRol = $this->tpRolRepository->create($input);

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

        $valor = $this->validPermisoMenu(9);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRol = $this->tpRolRepository->find($id);

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

        $valor = $this->validPermisoMenu(9);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpRol = $this->tpRolRepository->find($id);

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
     * @param UpdateTpRolRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpRolRequest $request)
    {
        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }
        $input = $request->all();
        // $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

            'description' => 'required|unique:roles,description,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('roles.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpRol = $this->tpRolRepository->update($input, $id);

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
        $tpRol = $this->tpRolRepository->find($id);

        if (empty($tpRol)) {
            Flash::error('Rol no encontrado');

            return redirect(route('roles.index'));
        }

        $this->tpRolRepository->delete($id);

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
      $statusUpd ->status_user  = ($statusUpd ->status_user == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
