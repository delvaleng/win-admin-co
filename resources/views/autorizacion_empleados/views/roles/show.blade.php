@extends('layouts.app')
@section('title', 'Rol')

@section('css')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Rol
  </h1>
</section>
  <div class="content">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('roles.show_fields')
          <a href="{!! route('roles.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
