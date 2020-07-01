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
        {!! Form::model($state, ['route' => ['departamentos.update', $state->id], 'method' => 'patch']) !!}
          @include('states.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
