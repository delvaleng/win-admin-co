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
      <div class="row" style="padding-left: 20px">
        @include('autorizacion_empleados.show_fields')
        <a href="{!! route('autorizacionEmpleados.index') !!}" class="btn btn-default">Regresar</a>
      </div>
    </div>
  </div>
</div>
@endsection
