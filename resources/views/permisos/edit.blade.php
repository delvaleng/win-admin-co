@extends('layouts.app')
@section('title', 'Permisos')

@section('content')
<section class="content-header">
  <h1>
    Permiso
  </h1>
</section>

<div class="content">
  @include('adminlte-templates::common.errors')
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($permiso, ['route' => ['permisos.update', $permiso->id], 'method' => 'patch']) !!}
          @include('permisos.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
