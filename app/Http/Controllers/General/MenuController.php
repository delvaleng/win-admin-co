<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Repositories\MenuRepository;

use App\Models\General\Rol_User;
use App\Models\General\Rol_Main;

use App\Models\General\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class MenuController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

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

    /**
     * Display a listing of the Menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $main = new MainClass();
        $main = $main->getMain();

        $valor = $this->validPermisoMenu(7);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        return view('menus.index')
        ->with('main',   $main);
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $section = Main::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
      $section->prepend("Menú Principal", '0');

      return view('menus.create')
      ->with('section', $section)
      ->with('main',    $main);
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();
        $input{'modified_by'} = auth()->user()->id;

        $menu = $this->menuRepository->create($input);

        Flash::success('Menú guardado con éxito.');

        return redirect(route('menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu(7);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        return view('menus.show')
        ->with('main',   $main)
        ->with('menu',   $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

      $valor = $this->validPermisoMenu(7);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $section = Main::WHERE('status_user', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
      $section->prepend("Menú Principal", '0');

      $menu    = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        return view('menus.edit')
        ->with('section', $section)
        ->with('main',    $main)
        ->with('menu',    $menu);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int $id
     * @param UpdateMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $menu  = $this->menuRepository->find($id);

        $input = $request->all();
        $input{'modified_by'} = auth()->user()->id;

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        $menu = $this->menuRepository->update($input, $id);

        Flash::success('Menú actualizado con éxito.');

        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menú no encontrado');

            return redirect(route('menus.index'));
        }

        $this->menuRepository->delete($id);

        Flash::success('Menú actualizado con éxito.');

        return redirect(route('menus.index'));
    }

    public function getMains(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Main)->newQuery();

       if($formulario{'menu'})    { $data = $data->where('description', $formulario{'menu'   });}
       if($formulario{'section'}) { $data = $data->where('section',     $formulario{'section'});}

        $data = $data->get();


       return response()->json([
         'data' => $data,
       ]);
    }

}
