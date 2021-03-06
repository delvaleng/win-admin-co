@extends('layouts.app')
@section('title', 'Horario')

@section('content')
<section class="content-header">
  <h1>
    Horario
  </h1>
</section>

<div class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row" style="padding-left: 20px">
        @include('horarios.show_fields')
        <a href="{!! route('marcaciones-conf-horarios.show', [$horario->id_horario_user]) !!}" class="btn btn-default">Volver</a>
      </div>
    </div>
  </div>
</div>
@endsection
