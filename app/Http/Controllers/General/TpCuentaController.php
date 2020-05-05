<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\TpCuenta;
use App\Models\General\Roles;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpCuentaController extends AppBaseController
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

        $valor = $this->validPermisoMenu(11);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpCuentas = TpCuenta::all();

        return view('tp_cuentas.index')
            ->with('tpCuentas', $tpCuentas)
            ->with('main',    $main);

    }


    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        return view('tp_cuentas.create')
        ->with('main',   $main);
    }


    public function store()
    {
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

          'description' => 'required|unique:tp_cuentas',
        ]);

        if ($validator->fails()) {

            return redirect(route('tp-cuentas.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $tpCuenta = TpCuenta::create($input);

        Flash::success('Tipo de cuenta guardado con éxito.');

        return redirect(route('tp-cuentas.index'));
    }


    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(11);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpCuenta = TpCuenta::find($id);

        if (empty($tpCuenta)) {
            Flash::error('Tipo de cuenta no encontrado');

            return redirect(route('tp-cuentas.index'));
        }

        return view('tp_cuentas.show')
        ->with('tpCuenta',  $tpCuenta)
        ->with('main',   $main);
    }


    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(11);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpCuenta = TpCuenta::find($id);

        if (empty($tpCuenta)) {
            Flash::error('Tipo de cuenta no encontrado');

            return redirect(route('tp-cuentas.index'));
        }

        return view('tp_cuentas.edit')
        ->with('tpCuenta', $tpCuenta)
        ->with('main',  $main);
    }


    public function update($id)
    {
        $tpCuenta = TpCuenta::find($id);

        if (empty($tpCuenta)) {
            Flash::error('Tipo de cuenta no encontrado');

            return redirect(route('tp-cuentas.index'));
        }
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

            'description' => 'required|unique:tp_cuentas,description,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('tp-cuentas.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpCuenta->update($input);

        Flash::success('Tipo de cuenta se actualizó con éxito.');

        return redirect(route('tp-cuentas.index'));
    }


    public function destroy($id)
    {
      $tpCuenta = TpCuenta::find($id);

        if (empty($tpCuenta)) {
            Flash::error('Tipo de cuenta no encontrado');

            return redirect(route('tp-cuentas.index'));
        }

        $this->tpCuentaRepository->delete($id);

        Flash::success('Tipo de cuenta eliminado con éxito');

        return redirect(route('tp-cuentas.index'));
    }


    public function getTpCuentas()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new TpCuenta)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TpCuenta::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
