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
      <div class="row" style="padding-left: 20px">
        @include('cities.show_fields')
        <a href="{!! route('ciudades.index') !!}" class="btn btn-default">Atras</a>
      </div>
    </div>
  </div>
</div>
@endsection
