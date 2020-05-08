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
        <div class="row">
          {!! Form::model($rolMenu, ['route' => ['rol-menus.update', $rolMenu->id], 'method' => 'patch' , 'id'=>'formEditRolMenus']) !!}
            @include('rol_menus.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/rol_menus/edit.js')}} "></script>
@endsection
