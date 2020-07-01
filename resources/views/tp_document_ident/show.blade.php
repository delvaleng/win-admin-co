@extends('layouts.app')
@section('title', 'Documento Identidad')

@section('content')
<section class="content-header">
  <h1>
    Documento Identidad
  </h1>
</section>

  <div class="content">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('tp_document_ident.show_fields')
          <a href="{!! route('tp-documentos-identidad.index') !!}" class="btn btn-default">Volver</a>
        </div>
      </div>
    </div>
  </div>
@endsection
