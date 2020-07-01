<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Country;
use App\Models\Admin\State;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class StateController extends AppBaseController
{
    private $menuid = 18;

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

        return view('states.index')
        ->with('main', $main);
    }

    /**
     * Show the form for creating a new State.
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

      $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country_name', 'ASC')->pluck('country_name', 'id');
        return view('states.create', compact('country', 'main'));
    }

    /**
     * Store a newly created State in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input     = request()->all();

        $input{'state_name'} = mb_strtoupper($input{'state_name'});

        $state = State::create($input);

        // Flash::success('State saved successfully.');

        return redirect(route('departamentos.index'));
    }

    /**
     * Display the specified State.
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

      $state = State::find($id);
      $country     = Country::WHERE('status', '=', 'TRUE')->orderBy('country_name', 'ASC')->pluck('country_name', 'id');

        if (empty($state)) {
            // Flash::error('State not found');

            return redirect(route('departamentos.index'));
        }

        return view('states.show')
        ->with('main', $main)
        ->with('state', $state)
        ->with('country', $country);
    }

    /**
     * Show the form for editing the specified State.
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

      $state = State::find($id);
      $country     = Country::WHERE('status', '=', 'TRUE')->orderBy('country_name', 'ASC')->pluck('country_name', 'id');

        if (empty($state)) {
            // Flash::error('State not found');

            return redirect(route('departamentos.index'));
        }

        return view('states.edit')
        ->with('main', $main)
        ->with('state', $state)
        ->with('country', $country);
    }

    /**
     * Update the specified State in storage.
     *
     * @param int $id
     * @param UpdateState
     *
     * @return Response
     */
    public function update($id)
    {
        $state = State::find($id);

        if (empty($state)) {
            // Flash::error('State not found');

            return redirect(route('departamentos.index'));
        }
        $input                = request()->all();
        $input{'state_name'} = mb_strtoupper($input{'state_name'});

        $state->update($input);

        // Flash::success('State updated successfully.');

        return redirect(route('departamentos.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $state = State::find($id);

        if (empty($state)) {
            // Flash::error('State not found');

            return redirect(route('departamentos.index'));
        }

        State::delete($id);

        // Flash::success('State deleted successfully.');

        return redirect(route('departamentos.index'));
    }
    public function get()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data       = (new State)->with('getCountry')->newQuery();
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }
    public function status()
    {
      $id        = request()->id;
      $statusUpd = State::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
