@extends('layouts.app')
@section('title', 'Ciudades')

@section('content')
<section class="content-header">
  <h1>
    Ciudades
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($city, ['route' => ['ciudades.update', $city->id], 'method' => 'patch']) !!}
          @include('cities.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
