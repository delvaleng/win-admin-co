<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateDepartamentRequest;
use App\Http\Requests\UpdateDepartamentRequest;
use App\Repositories\DepartamentRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;

use Illuminate\Http\Request;
use App\Models\General\Country;
use App\Models\General\Departament;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class DepartamentController extends AppBaseController
{

  public function validPermisoMenu($id_main) {

    $roles = Rol_User::where('id_user', auth()->user()->id)->get();
    foreach ($roles as $key) {
      if($key->id_role == 2){
        return true;
      }
      else{
        $menu = Rol_Main::where('id_role', $key->id_role)->where('id_main', $id_main)->first();

        if($menu){
          return true;
        }
      }
    }
    return false;

  }

    /** @var  DepartamentRepository */
    private $departamentRepository;

    public function __construct(DepartamentRepository $departamentRepo)
    {
        $this->departamentRepository = $departamentRepo;
    }

    /**
     * Display a listing of the Departament.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(1);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $departaments = $this->departamentRepository->with('getCountry')->all();

        return view('departaments.index')
        ->with('main', $main)
        ->with('departaments', $departaments);
    }

    /**
     * Show the form for creating a new Departament.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(1);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
        return view('departaments.create', compact('country', 'main'));
    }

    /**
     * Store a newly created Departament in storage.
     *
     * @param CreateDepartamentRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartamentRequest $request)
    {
        $input     = $request->all();

        $input{'departament'} = mb_strtoupper($input{'departament'});

        $departament = $this->departamentRepository->create($input);

        // Flash::success('Departament saved successfully.');

        return redirect(route('estados.index'));
    }

    /**
     * Display the specified Departament.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(1);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $departament = $this->departamentRepository->find($id);
      $country     = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');

        if (empty($departament)) {
            // Flash::error('Departament not found');

            return redirect(route('estados.index'));
        }

        return view('departaments.show')
        ->with('main', $main)
        ->with('departament', $departament)
        ->with('country', $country);
    }

    /**
     * Show the form for editing the specified Departament.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(1);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $departament = $this->departamentRepository->find($id);
      $country     = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');

        if (empty($departament)) {
            // Flash::error('Departament not found');

            return redirect(route('estados.index'));
        }

        return view('departaments.edit')
        ->with('main', $main)
        ->with('departament', $departament)
        ->with('country', $country);
    }

    /**
     * Update the specified Departament in storage.
     *
     * @param int $id
     * @param UpdateDepartamentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartamentRequest $request)
    {
        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            // Flash::error('Departament not found');

            return redirect(route('estados.index'));
        }
        $input                = $request->all();
        $input{'departament'} = mb_strtoupper($input{'departament'});

        $departament = $this->departamentRepository->update($input, $id);

        // Flash::success('Departament updated successfully.');

        return redirect(route('estados.index'));
    }

    /**
     * Remove the specified Departament from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            // Flash::error('Departament not found');

            return redirect(route('estados.index'));
        }

        $this->departamentRepository->delete($id);

        // Flash::success('Departament deleted successfully.');

        return redirect(route('estados.index'));
    }
    public function get(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data       = (new Departament)->with('getCountry')->newQuery();
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }
    public function status()
    {
      $id        = request()->id;
      $statusUpd = Departament::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
