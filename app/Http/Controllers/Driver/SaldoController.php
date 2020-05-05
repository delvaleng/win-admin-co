<?php

namespace App\Http\Controllers\Driver;

use App\Http\Requests\CreateAuditoriaRequest;
use App\Http\Requests\UpdateAuditoriaRequest;
use App\Repositories\AuditoriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\Main;
use App\Models\General\Country;
use App\Classes\MainClass;
use App\Models\DriverSaldo;
use Flash;
use Response;

class SaldoController extends AppBaseController
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

  public function getData()
  {

    $formulario = request()->formulario;
    $data       = (new DriverSaldo)->with('getCountry')->newQuery();

    if($formulario{'country_form'}) { $data = $data->where('id_country',       $formulario{'country_form'});}
    if($formulario{'usuario_form'}) { $data = $data->where('usuario_oficina', $formulario{'usuario_form'}); }

    $data = $data->get();

    return response()->json([
      'data' => $data,
    ]);
  }

  public function index()
  {
    $main = new MainClass();
    $main = $main->getMain();

    $valor = $this->validPermisoMenu(16);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }
    $country        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');


      return view('saldos.index')
      ->with('country', $country)
      ->with('main', $main);
  }

  public function updateStatus()
  {
    $id        = request()->id;
    $statusUpd = DriverSaldo::find($id);
    $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
    $statusUpd ->update();
    return response()->json([
      'object' => 'success',
    ]);
  }

}
