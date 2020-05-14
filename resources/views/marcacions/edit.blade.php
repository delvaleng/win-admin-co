@extends('layouts.app')
@section('title', 'Marcaciones')

@section('content')
<section class="content-header">
  <h1>
    Marcacion
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($marcacion, ['route' => ['marcacions.update', $marcacion->id], 'method' => 'patch']) !!}
          @include('marcacions.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
