<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateAlcaldiaRequest;
use App\Http\Requests\UpdateAlcaldiaRequest;
use App\Repositories\AlcaldiaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\General\Departament;
use App\Models\General\Country;
use App\Models\General\City;

use App\Models\General\Alcaldia;
use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Main;

use App\Classes\MainClass;
use Flash;
use Response;

class AlcaldiaController extends AppBaseController
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

    /** @var  AlcaldiaRepository */
    private $alcaldiaRepository;

    public function __construct(AlcaldiaRepository $alcaldiaRepo)
    {
        $this->alcaldiaRepository = $alcaldiaRepo->with('getCity', 'getDepartamentCity');
    }

    /**
     * Display a listing of the Alcaldia.
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


        return view('alcaldias.index')
        ->with('main', $main)
        ->with('alcaldias', null);
    }

    /**
     * Show the form for creating a new Alcaldia.
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

      $country        = country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
      $departament    = null;
      $city           = null;
      $country_id     = null;
      $departament_id = null;
      $city_id        = null;


      return view('alcaldias.create', compact('country', 'main',
      'departament', 'city',
      'country_id', 'departament_id', 'city_id'));
    }

    /**
     * Store a newly created Alcaldia in storage.
     *
     * @param CreateAlcaldiaRequest $request
     *
     * @return Response
     */
    public function store(CreateAlcaldiaRequest $request)
    {
        $input = $request->all();
        $input{'name'} = strtoupper($input{'name'});


        $alcaldia = $this->alcaldiaRepository->create($input);

        // Flash::success('Alcaldia saved successfully.');

        return redirect(route('alcaldias.index'));
    }

    /**
     * Display the specified Alcaldia.
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

        $alcaldia = $this->alcaldiaRepository->find($id);
        $departament        = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');

        if (empty($alcaldia)) {
            // Flash::error('Alcaldia not found');

            return redirect(route('alcaldias.index'));
        }

        return view('alcaldias.show')->with('alcaldia', $alcaldia)
        ->with('main', $main)
        ->with('departament', $departament);
    }

    /**
     * Show the form for editing the specified Alcaldia.
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

      $alcaldia = $this->alcaldiaRepository->with('getDepartamentCity')->find($id);

      $country_id     = $alcaldia->getDepartamentCity[0]->id_country;
      $city_id        = $alcaldia->getDepartamentCity[0]->id;

      $departament_id = City::find($city_id)->id_departament;

      $city           = City::WHERE('status', '=', 'TRUE')->where('id_departament', $departament_id)
      ->orderBy('city', 'ASC')->pluck('city', 'id');

      $departament    = Departament::WHERE('status', '=', 'TRUE')->where('id_country', $country_id)
      ->orderBy('departament', 'ASC')->pluck('departament', 'id');

      $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');


        if (empty($alcaldia)) {
            // Flash::error('Alcaldia not found');
            return redirect(route('alcaldias.index'));
        }

        return view('alcaldias.edit')
        ->with('main', $main)
        ->with('country_id', $country_id)
        ->with('departament_id', $departament_id)
        ->with('city_id', $city_id)
        ->with('alcaldia', $alcaldia)
        ->with('country', $country)
        ->with('departament', $departament)
        ->with('city', $city);

    }

    /**
     * Update the specified Alcaldia in storage.
     *
     * @param int $id
     * @param UpdateAlcaldiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlcaldiaRequest $request)
    {
        $alcaldia = $this->alcaldiaRepository->find($id);

        if (empty($alcaldia)) {
            // Flash::error('Alcaldia not found');

            return redirect(route('alcaldias.index'));
        }
        $input = $request->all();
        $input{'name'} = strtoupper($input{'name'});

        $alcaldia = $this->alcaldiaRepository->update($input, $id);

        // Flash::success('Alcaldia updated successfully.');

        return redirect(route('alcaldias.index'));
    }

    /**
     * Remove the specified Alcaldia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alcaldia = $this->alcaldiaRepository->find($id);

        if (empty($alcaldia)) {
            // Flash::error('Alcaldia not found');

            return redirect(route('alcaldias.index'));
        }

        $this->alcaldiaRepository->delete($id);

        // Flash::success('Alcaldia deleted successfully.');

        return redirect(route('alcaldias.index'));
    }

    public function get($id)
    {
        if (!$id) {
            $html = '<option value="">'.trans('Seleccione una alcadía/municipio...').'</option>';
        } else {
            $html = '<option selected="selected" value="">Seleccione una alcadía/municipio...</option>';
            $datos = Alcaldia::where('id_city', $id)->where('status', TRUE)->get();
            foreach ($datos as $dato) {
                $html .= '<option value="'.$dato->id.'">'.$dato->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function getAlcaldias(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

      $data = \DB::table('alcaldias')
                ->select('alcaldias.id', 'alcaldias.id_city', 'alcaldias.name', 'alcaldias.status', 'alcaldias.created_at', 'alcaldias.updated_at',
                'countries.country', 'departaments.departament', 'cities.city')
                ->join('cities',       'cities.id',        '=', 'alcaldias.id_city')
                ->join('departaments', 'departaments.id',  '=', 'cities.id_departament')
                ->join('countries',    'countries.id',     '=', 'departaments.id_country')
                ->get();
       // $data       = $data->get();
       // dd($data[0]->departament);

       return response()->json([
         'data' => $data,
       ]);
    }
    public function status()
    {
      $id        = request()->id;
      $statusUpd = Alcaldia::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

}
