<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use App\Models\Admin\Country;
use App\Models\Admin\Departament;
use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;

use App\Models\Admin\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class CountryController extends AppBaseController
{
    private $menuid = 17;

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


    public function index()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $countries = Country::all();

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
      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      return view('countries.create',compact('main'));
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest request()
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();
        $input{'country_name'} = mb_strtoupper($input{'country_name'});
        $input{'area_code'}    = mb_strtoupper($input{'area_code'});


        $country = Country::create($input);

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
      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $country = Country::find($id);

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
      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $country = Country::find($id);

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
     * @param UpdateCountryRequest request()
     *
     * @return Response
     */
    public function update($id)
    {
        $country = Country::find($id);

        if (empty($country)) {
            // Flash::error('Country not found');
            return redirect(route('pais.index'));
        }
        $input = request()->all();
        $input{'country_name'} = mb_strtoupper($input{'country_name'});
        $input{'area_code'}    = mb_strtoupper($input{'area_code'});

        $country->update($input);

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
        $country = Country::find($id);

        if (empty($country)) {
            // Flash::error('Country not found');

            return redirect(route('pais.index'));
        }

        Country::delete($id);

        // Flash::success('Country deleted successfully.');

        return redirect(route('pais.index'));
    }

    public function get()
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
