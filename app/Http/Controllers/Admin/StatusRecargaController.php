<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Admin\StatusRecarga;
use App\Models\Admin\Rol_User;
use App\Models\Admin\Rol_Main;
use App\Models\Admin\Roles;
use App\Models\Admin\Main;

use App\Classes\MainClass;
use Flash;
use Response;

class StatusRecargaController extends AppBaseController
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

      $valor = $this->validPermisoMenu(14);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $statusRecargas = StatusRecarga::all();

      return view('status_recargas.index')
          ->with('statusRecargas', $statusRecargas)
          ->with('main',    $main);

    }


    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        return view('status_recargas.create')
        ->with('main',   $main);
    }


    public function store()
    {
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

          'description' => 'required|unique:status_recargas',
        ]);

        if ($validator->fails()) {

            return redirect(route('estatus-recargas.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $statusRecarga = StatusRecarga::create($input);

        Flash::success('Estatus de recarga guardado con éxito.');

        return redirect(route('estatus-recargas.index'));
    }


    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(14);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusRecarga = StatusRecarga::find($id);

        if (empty($statusRecarga)) {
            Flash::error('Estatus de recarga no encontrado');
            return redirect(route('estatus-recargas.index'));
        }

        return view('status_recargas.show')
        ->with('statusRecarga',  $statusRecarga)
        ->with('main',   $main);
    }


    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu(14);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $statusRecarga = StatusRecarga::find($id);

      if (empty($statusRecarga)) {
        Flash::error('Estatus de recarga no encontrado');
        return redirect(route('estatus-recargas.index'));
      }

      return view('status_recargas.edit')
      ->with('statusRecarga',  $statusRecarga)
      ->with('main',  $main);
    }


    public function update($id)
    {
      $statusRecarga = StatusRecarga::find($id);

        if (empty($statusRecarga)) {
          Flash::error('Estatus de recarga no encontrado');
          return redirect(route('estatus-recargas.index'));
        }
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [
          'description' => 'required|unique:tp_pagos,description,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('estatus-recargas.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $statusRecarga->update($input);

        Flash::success('Estatus de recarga se actualizó con éxito.');
        return redirect(route('estatus-recargas.index'));
    }


    public function destroy($id)
    {
      $statusRecarga = StatusRecarga::find($id);

        if (empty($statusRecarga)) {
          Flash::error('Estatus de recarga no encontrado');
          return redirect(route('estatus-recargas.index'));
        }

        $this->tpPagoRepository->delete($id);

        Flash::success('Estatus de recarga eliminado con éxito');

        return redirect(route('estatus-recargas.index'));
    }


    public function getTpCuentas()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new StatusRecarga)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TpPago::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
