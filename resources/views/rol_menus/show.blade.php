@extends('layouts.app')
@section('title', 'Rol\Menú')

@section('css')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Rol Men&uacute;
  </h1>
</section>
  <div class="content">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('rol_menus.show_fields')
          <a href="{!! route('rol-menus.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
