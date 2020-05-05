<?php

namespace App\Http\Controllers\General;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Country;
use App\Models\General\Departament;



use Illuminate\Http\Request;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class CountryController extends AppBaseController
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

    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(13);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $countries = $this->countryRepository->all();

      return view('countries.index')
        ->with('main', $main)
        ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(13);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      return view('countries.create',compact('main'));
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        // Flash::success('Country saved successfully.');

        return redirect(route('pais.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(13);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $country = $this->countryRepository->find($id);

        if (empty($country)) {
            // Flash::error('Country not found');

            return redirect(route('pais.index'));
        }

        return view('countries.show')
        ->with('main', $main)
        ->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      $valor = $this->validPermisoMenu(13);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $country = $this->countryRepository->find($id);

        if (empty($country)) {
            // Flash::error('Country not found');

            return redirect(route('pais.index'));
        }

        return view('countries.edit')
        ->with('main', $main)
        ->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            // Flash::error('Country not found');

            return redirect(route('pais.index'));
        }

        $country = $this->countryRepository->update($request->all(), $id);

        // Flash::success('Country updated successfully.');

        return redirect(route('pais.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            // Flash::error('Country not found');

            return redirect(route('pais.index'));
        }

        $this->countryRepository->delete($id);

        // Flash::success('Country deleted successfully.');

        return redirect(route('pais.index'));
    }

    public function get(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data       = (new Country)->newQuery();
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function get2($id)
    {
        if (!$id) {
            $html = '<option value="">'.trans('Seleccione un estado...').'</option>';
        } else {
            $html = '<option selected="selected" value="">Seleccione un estado...</option>';
            $datos = Departament::where('id_country', $id)->where('status', TRUE)->get();
            foreach ($datos as $dato) {
                $html .= '<option value="'.$dato->id.'">'.$dato->departament.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
    public function status()
    {
      $id        = request()->id;
      $statusUpd = Country::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

}
