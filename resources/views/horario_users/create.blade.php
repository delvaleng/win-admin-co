@extends('layouts.app')
@section('title', 'Horario Empleados')

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Horario Empleados
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::open(['route' => 'marcaciones-conf-horarios.store']) !!}
          @include('horario_users.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  })
</script>
@endsection
