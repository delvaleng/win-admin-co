<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;
use App\Models\General\TpPago;
use App\Models\General\Roles;
use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpPagoController extends AppBaseController
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

        $valor = $this->validPermisoMenu(10);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpPagos = TpPago::all();

        return view('tp_pagos.index')
            ->with('tpPagos', $tpPagos)
            ->with('main',    $main);

    }


    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

        return view('tp_pagos.create')
        ->with('main',   $main);
    }


    public function store()
    {
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

          'description' => 'required|unique:tp_pagos',
        ]);

        if ($validator->fails()) {

            return redirect(route('tp-pagos.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $tpPago = TpPago::create($input);

        Flash::success('Tipo de pago guardado con éxito.');

        return redirect(route('tp-pagos.index'));
    }


    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(10);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpPago = TpPago::find($id);

        if (empty($tpPago)) {
            Flash::error('Tipo de pago no encontrado');

            return redirect(route('tp-pagos.index'));
        }

        return view('tp_pagos.show')
        ->with('tpPago',  $tpPago)
        ->with('main',   $main);
    }


    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $valor = $this->validPermisoMenu(10);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $tpPago = TpPago::find($id);

        if (empty($tpPago)) {
            Flash::error('Tipo de pago no encontrado');

            return redirect(route('tp-pagos.index'));
        }

        return view('tp_pagos.edit')
        ->with('tpPago', $tpPago)
        ->with('main',  $main);
    }


    public function update($id)
    {
        $tpPago = TpPago::find($id);

        if (empty($tpPago)) {
            Flash::error('Tipo de pago no encontrado');

            return redirect(route('tp-pagos.index'));
        }
        $input = request()->all();
        $input{'description'} = mb_strtoupper($input{'description'});

        $validator = Validator::make($input, [

            'description' => 'required|unique:tp_pagos,description,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('tp-pagos.create'))
             ->withErrors($validator)
             ->withInput();
        }

        $tpPago->update($input);

        Flash::success('Tipo de pago se actualizó con éxito.');

        return redirect(route('tp-pagos.index'));
    }


    public function destroy($id)
    {
      $tpPago = TpPago::find($id);

        if (empty($tpPago)) {
            Flash::error('Tipo de pago no encontrado');

            return redirect(route('tp-pagos.index'));
        }

        $this->tpPagoRepository->delete($id);

        Flash::success('Tipo de pago eliminado con éxito');

        return redirect(route('tp-pagos.index'));
    }


    public function getTpCuentas()
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new TpPago)->newQuery();
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
