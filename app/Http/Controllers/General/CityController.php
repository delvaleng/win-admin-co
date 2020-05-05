<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\General\Departament;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;

use App\Models\General\Main;
use App\Models\General\City;

use App\Classes\MainClass;
use Flash;
use Response;

class CityController extends AppBaseController
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

    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
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

      $cities = $this->cityRepository->with('getDepartamentCountry', 'getDepartament')->all();

        return view('cities.index')
        ->with('main', $main)
        ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new City.
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

      $departament        = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');

      return view('cities.create', compact('departament', 'main'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();
        $input{'city'} = strtoupper($input{'city'});


        $city = $this->cityRepository->create($input);

        // Flash::success('City saved successfully.');

        return redirect(route('ciudad.index'));
    }

    /**
     * Display the specified City.
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

        $city = $this->cityRepository->find($id);
        $departament        = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudad.index'));
        }

        return view('cities.show')->with('city', $city)
        ->with('main', $main)
        ->with('departament', $departament);
    }

    /**
     * Show the form for editing the specified City.
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

      $city = $this->cityRepository->find($id);
      $departament        = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');


        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudad.index'));
        }

        return view('cities.edit')
        ->with('main', $main)
        ->with('city', $city)
        ->with('departament', $departament);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudad.index'));
        }
        $input = $request->all();
        $input{'city'} = strtoupper($input{'city'});

        $city = $this->cityRepository->update($input, $id);

        // Flash::success('City updated successfully.');

        return redirect(route('ciudad.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudad.index'));
        }

        $this->cityRepository->delete($id);

        // Flash::success('City deleted successfully.');

        return redirect(route('ciudad.index'));
    }

    public function get($id)
    {
        if (!$id) {
            $html = '<option value="">'.trans('Seleccione una ciudad...').'</option>';
        } else {
            $html = '<option selected="selected" value="">Seleccione una ciudad...</option>';
            $datos = City::where('id_departament', $id)->where('status', TRUE)->get();
            foreach ($datos as $dato) {
                $html .= '<option value="'.$dato->id.'">'.$dato->city.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function getCities(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data       = (new City)->with('getDepartamentCountry', 'getDepartament')->newQuery();
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }
    public function status()
    {
      $id        = request()->id;
      $statusUpd = City::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

}
