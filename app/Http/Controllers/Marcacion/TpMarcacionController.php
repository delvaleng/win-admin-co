<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\Admin\TpMarcacion;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpMarcacionController extends AppBaseController
{
  private $menuid = 14;

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

    /**
     * Display a listing of the TpMarcacion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }


        $tpMarcacions = TpMarcacion::all();

        return view('tp_marcacions.index')
        ->with('tpMarcacions', $tpMarcacions)
        ->with('main',         $main);
    }

    /**
     * Show the form for creating a new TpMarcacion.
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

      return view('tp_marcacions.create')
      ->with('main', $main);
    }

    /**
     * Store a newly created TpMarcacion in storage.
     *
     * @param CreateTpMarcacionRequest $request
     *
     * @return Response
     */
    public function store(CreateTpMarcacionRequest $request)
    {
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $tpMarcacion = TpMarcacion::create($input);

        Flash::success('Marcacion guardada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }

    /**
     * Display the specified TpMarcacion.
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

        $tpMarcacion = TpMarcacion::find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        return view('tp_marcacions.show')
        ->with('tpMarcacion', $tpMarcacion)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified TpMarcacion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();
      return view('errors.403', compact('main'));

        $tpMarcacion = TpMarcacion::find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        return view('tp_marcacions.edit')
        ->with('tpMarcacion', $tpMarcacion)
        ->with('main',        $main);
    }

    /**
     * Update the specified TpMarcacion in storage.
     *
     * @param int $id
     * @param UpdateTpMarcacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpMarcacionRequest $request)
    {
        $tpMarcacion = TpMarcacion::find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        $tpMarcacion = TpMarcacion::update($input, $id);

        Flash::success('Marcacion actualizada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }

    /**
     * Remove the specified TpMarcacion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpMarcacion = TpMarcacion::find($id);

        if (empty($tpMarcacion)) {
            Flash::error('Marcacion no encontrado');

            return redirect(route('tpMarcacions.index'));
        }

        TpMarcacion::delete($id);

        Flash::success('Marcacion eliminada exitosamente.');

        return redirect(route('tpMarcacions.index'));
    }
}
