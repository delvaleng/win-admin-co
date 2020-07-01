@extends('layouts.app')
@section('title', 'Departamentos')

@section('content')
<section class="content-header">
  <h1>
    Estado
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::open(['route' => 'departamentos.store']) !!}
          @include('states.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
