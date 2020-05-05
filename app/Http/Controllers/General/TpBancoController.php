<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\TpBanco;
use App\Models\General\Country;
use App\Models\General\TpCuenta;
use App\Models\General\Roles;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpBancoController extends AppBaseController
{

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


    public function index( )
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(12);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpBancos = TpBanco::with('getTpCuenta', 'getCountry')->get();

        return view('tp_bancos.index')
            ->with('tpBancos', $tpBancos)
            ->with('main',     $main);

    }

    public function create()
    {
      $main      = new MainClass();
      $main      = $main->getMain();
      $tpcuenta  = TpCuenta::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
      $country   = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');

        return view('tp_bancos.create')
        ->with('tpcuenta',   $tpcuenta)
        ->with('country',    $country)
        ->with('main',       $main);

    }


    public function store()
    {
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [
          'description' => 'required|unique:tp_bancos',
        ]);

        if ($validator->fails()) {

            return redirect(route('tp-bancos.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $tpCuenta = TpBanco::create($input);

        Flash::success('Tipo de banco guardado con éxito.');

        return redirect(route('tp-bancos.index'));
    }


    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(12);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpBanco = TpBanco::with('getTpCuenta', 'getCountry')->find($id);

        if (empty($tpBanco)) {
            Flash::error('Tipo de banco no encontrado');

            return redirect(route('tp-bancos.index'));
        }

        return view('tp_bancos.show')
        ->with('tpBanco',  $tpBanco)
        ->with('main',   $main);
    }


    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(12);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpBanco   = TpBanco::with('getTpCuenta')->find($id);
        $tpcuenta  = TpCuenta::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
        $country   = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');


        if (empty($tpBanco)) {
            Flash::error('Tipo de banco no encontrado');

            return redirect(route('tp-bancos.index'));
        }

        return view('tp_bancos.edit')
        ->with('tpBanco', $tpBanco)
        ->with('tpcuenta',   $tpcuenta)
        ->with('country',    $country)
        ->with('main',  $main);
    }


    public function update($id)
    {
        $tpBanco = TpBanco::with('getTpCuenta')->find($id);

        if (empty($tpBanco)) {
            Flash::error('Tipo de banco no encontrado');
            return redirect(route('tp-bancos.index'));
        }
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [
          'description' => 'required|unique:tp_bancos,description,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('tp-bancos.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpBanco->update($input);

        Flash::success('Tipo de banco se actualizó con éxito.');

        return redirect(route('tp-bancos.index'));
    }


    public function destroy($id)
    {
      $tpBanco = TpBanco::find($id);

        if (empty($tpBanco)) {
            Flash::error('Tipo de banco no encontrado');

            return redirect(route('tp-bancos.index'));
        }

        $tpBanco->delete($id);

        Flash::success('Tipo de banco eliminado con éxito');

        return redirect(route('tp-bancos.index'));
    }


    public function getTpBancos()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new TpBanco)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TpBanco::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
