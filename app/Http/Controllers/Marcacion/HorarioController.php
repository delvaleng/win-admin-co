<?php

namespace App\Http\Controllers\Marcacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Marcaciones\Horario;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Flash;
use Response;

class HorarioController extends AppBaseController
{
  private $menuid = 15;

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
     * Display a listing of the Horario.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu();
      if ($valor == false){
        return view('errors.403', compact('main'));
      }


        $horarios = Horario::all();

        return view('horarios.index')
        ->with('horarios', $horarios)
        ->with('main',     $main);
    }

    /**
     * Show the form for creating a new Horario.
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

      $horario = null;

        return view('horarios.create')
        ->with('horario', $horario)
        ->with('main',    $main);
    }

    /**
     * Store a newly created Horario in storage.
     *
     * @param CreateHorarioRequest $request
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();

        $horario = Horario::create($input);

        Flash::success('Horario guardado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.show', [$horario->id_horario_user]));

        // return redirect(route('horarios.index'));
    }

    /**
     * Display the specified Horario.
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

        $horario = Horario::find($id);

        if (empty($horario)) {
            Flash::error('Horario no encontrado');

            return redirect(route('horarios.index'));
        }

        return view('horarios.show')
        ->with('horario', $horario)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified Horario.
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

        $horario = Horario::find($id);

        if (empty($horario)) {
            Flash::error('Horario no encontrado');

            return redirect(route('horarios.index'));
        }

        return view('horarios.edit')
        ->with('horario', $horario)
        ->with('main',    $main);
    }

    /**
     * Update the specified Horario in storage.
     *
     * @param int $id
     * @param UpdateHorarioRequest $request
     *
     * @return Response
     */
    public function update($id)
    {
        $horario = Horario::find($id);

        if (empty($horario)) {
            Flash::error('Horario no encontrado');

            return redirect(route('horarios.index'));
        }

        $horario->update(request()->all());

        Flash::success('Horario actualizado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.show', [$horario->id_horario_user]));

        // return redirect(route('horarios.index'));
    }

    /**
     * Remove the specified Horario from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $horario = Horario::find($id);

        if (empty($horario)) {
            Flash::error('Horario no encontrado');

            return redirect(route('horarios.index'));
        }

        $horario->delete();

        Flash::success('Horario eliminado exitosamente.');

        return redirect(route('marcaciones-conf-horarios.show', [$horario->id_horario_user]));
    }
}
