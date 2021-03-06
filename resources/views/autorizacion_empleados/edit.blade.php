@extends('layouts.app')
@section('title', 'Autorizacion Empleados')

@section('content')
<section class="content-header">
  <h1>
    Autorizacion Empleado
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($autorizacionEmpleado, ['route' => ['marcaciones-autorizaciones.update', $autorizacionEmpleado->id], 'method' => 'patch']) !!}
          @include('autorizacion_empleados.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
