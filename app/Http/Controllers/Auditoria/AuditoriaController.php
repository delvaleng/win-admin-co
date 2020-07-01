<?php

namespace App\Http\Controllers\Auditoria;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\Admin\Auditoria;
use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;

use Flash;
use Response;

class AuditoriaController extends AppBaseController
{

  private $menuid = 22;

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

  public function get()
  {
    ini_set('memory_limit','-1');

    $formulario = request()->formulario;

    $data = (new Auditoria)->newQuery();

    if($formulario{'campo_search'})    {
      $data = $data->where('old_values', 'like', '%' . $formulario{'campo_search'} . '%')->orWhere('new_values', 'like', '%' . $formulario{'campo_search'} . '%');
    }

     $data = $data->with('userModified')->get();


   return response()->json([
     'data' => $data,
   ]);
  }

  public function index()
  {
    $main = new MainClass();
    $main = $main->getMain();

    $valor = $this->validPermisoMenu();
    if ($valor == false){
      return view('errors.403', compact('main'));
    }
      $auditoria = Auditoria::all();

      return view('auditoria.index')
      ->with('main', $main)
      ->with('auditoria', $auditoria);
  }

  public function create()
  {
    $main = new MainClass();
    $main = $main->getMain();
    return view('errors.403', compact('main'));
  }

  public function store(CreateAuditoriaRequest $request)
  {
    $input = $request->all();

      $auditoria = Auditoria::create($input);

    return redirect(route('auditoria.index'));
  }

  public function show($id)
  {
    $main = new MainClass();
    $main = $main->getMain();
    $valor = $this->validPermisoMenu();
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

      $auditoria = Auditoria::with('userModified')->find($id);

      if (empty($auditoria)) {
          // Flash::error('Office Virtual not found');

          return redirect(route('auditoria.index'));
      }

      return view('auditoria.show')
      ->with('main', $main)
      ->with('auditoria', $auditoria);
  }

  public function edit($id)
  {
    $main = new MainClass();
    $main = $main->getMain();
    return view('errors.403', compact('main'));
  }

}
