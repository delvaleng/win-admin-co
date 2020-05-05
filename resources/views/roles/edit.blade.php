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
        <div class="row">
          {!! Form::model($tpRol, ['route' => ['roles.update', $tpRol->id], 'method' => 'patch']) !!}
            @include('roles.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
