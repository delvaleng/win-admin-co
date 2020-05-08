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
        {!! Form::open(['route' => 'empleados.store']) !!}
          @include('empleados.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
