<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\Admin\TpDocumentIdent;

use App\Models\Admin\RolUser;
use App\Models\Admin\RolMain;
use App\Models\Admin\Main;
use App\Classes\MainClass;
use Flash;
use Response;

class TpDocumentIdentController extends AppBaseController
{

    public function index()
    {
      $main = new MainClass();
      $main = $main->getMain();

      $tpDocumentIdents = TpDocumentIdent::all();

      return view('tp_document_ident.index')
      ->with('tpDocumentIdents', $tpDocumentIdents)
      ->with('main',                  $main);
    }

    /**
     * Show the form for creating a new tpDocumentIdent.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MainClass();
      $main = $main->getMain();

      return view('tp_document_ident.create')
      ->with('main', $main);
    }

    /**
     * Store a newly created tpDocumentIdent in storage.
     *
     * @param CreatetpDocumentIdentRequest $request
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->all();

        $tpDocumentIdent = TpDocumentIdent::create($input);

        Flash::success('Documento Identidad guardado exitosamente.');

        return redirect(route('tp-documentos-identidad.index'));
    }

    /**
     * Display the specified tpDocumentIdent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpDocumentIdent = TpDocumentIdent::find($id);

        if (empty($tpDocumentIdent)) {
            Flash::error('Documento Identidad no encontrado');
            return redirect(route('tp-documentos-identidad.index'));
        }

        return view('tp_document_ident.show')
        ->with('tpDocumentIdent', $tpDocumentIdent)
        ->with('main',                 $main);
    }

    /**
     * Show the form for editing the specified tpDocumentIdent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MainClass();
      $main = $main->getMain();

        $tpDocumentIdent = TpDocumentIdent::find($id);

        if (empty($tpDocumentIdent)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tp-documentos-identidad.index'));
        }

        return view('tp_document_ident.edit')
        ->with('tpDocumentIdent', $tpDocumentIdent)
        ->with('main',                 $main);
    }

    /**
     * Update the specified tpDocumentIdent in storage.
     *
     * @param int $id
     * @param UpdatetpDocumentIdentRequest $request
     *
     * @return Response
     */
    public function update($id)
    {
        $tpDocumentIdent = TpDocumentIdent::find($id);

        if (empty($tpDocumentIdent)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tp-documentos-identidad.index'));
        }

        $tpDocumentIdent->update($request->all());

        Flash::success('Documento Identidad actualizada exitosamente.');

        return redirect(route('tp-documentos-identidad.index'));
    }

    /**
     * Remove the specified tpDocumentIdent from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tpDocumentIdent = TpDocumentIdent::find($id);

        if (empty($tpDocumentIdent)) {
            Flash::error('Documento Identidad no encontrado');

            return redirect(route('tp-documentos-identidad.index'));
        }

        TpDocumentIdent::delete($id);

        Flash::success('Documento Identidad eliminado exitosamente.');

        return redirect(route('tp-documentos-identidad.index'));
    }
}
