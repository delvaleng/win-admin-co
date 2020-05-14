@extends('layouts.app')
@section('title', 'Estado')

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
        {!! Form::open(['route' => 'estados.store']) !!}
          @include('departaments.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
