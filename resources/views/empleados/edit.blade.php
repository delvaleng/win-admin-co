@extends('layouts.app')
@section('title', 'Empleados')

@section('content')
<section class="content-header">
  <h1>
    Empleados
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($empleado, ['route' => ['empleados.update', $empleado->id], 'method' => 'patch']) !!}
          @include('empleados.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
