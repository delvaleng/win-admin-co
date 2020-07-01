<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\Admin\State;
use App\Models\Admin\City;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Flash;
use Response;

class CityController extends AppBaseController
{

    private $menuid = 19;

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

        return view('cities.index')
        ->with('main', $main);
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

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $state        = State::WHERE('status', '=', 'TRUE')->orderBy('state_name', 'ASC')->pluck('state_name', 'id');

      return view('cities.create', compact('state', 'main'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest request()
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();
        $input{'city_name'} = strtoupper($input{'city_name'});


        $city = City::create($input);

        // Flash::success('City saved successfully.');

        return redirect(route('ciudades.index'));
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
      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $city = City::find($id);
        $state        = State::WHERE('status', '=', 'TRUE')->orderBy('state_name', 'ASC')->pluck('state_name', 'id');

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudades.index'));
        }

        return view('cities.show')->with('city', $city)
        ->with('main', $main)
        ->with('state', $state);
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

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $city = City::find($id);
      $state        = State::WHERE('status', '=', 'TRUE')->orderBy('state_name', 'ASC')->pluck('state_name', 'id');


        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudades.index'));
        }

        return view('cities.edit')
        ->with('main', $main)
        ->with('city', $city)
        ->with('state', $state);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest request()
     *
     * @return Response
     */
    public function update($id)
    {
        $city = City::find($id);

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudades.index'));
        }
        $input = request()->all();
        $input{'city_name'} = strtoupper($input{'city_name'});

        $city->update($input);

        // Flash::success('City updated successfully.');

        return redirect(route('ciudades.index'));
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
        $city = City::find($id);

        if (empty($city)) {
            // Flash::error('City not found');

            return redirect(route('ciudades.index'));
        }

        City::delete($id);

        // Flash::success('City deleted successfully.');

        return redirect(route('ciudades.index'));
    }

    public function get($id)
    {
        if (!$id) {
            $html = '<option value="">'.trans('Seleccione una ciudades...').'</option>';
        } else {
            $html = '<option selected="selected" value="">Seleccione una ciudades...</option>';
            $datos = City::where('id_departament', $id)->where('status', TRUE)->get();
            foreach ($datos as $dato) {
                $html .= '<option value="'.$dato->id.'">'.$dato->city_name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function getCities()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data       = (new City)->with('getStateCountry', 'getState')->newQuery();
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
