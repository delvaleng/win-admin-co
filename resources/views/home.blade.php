@extends('layouts.app')
@section('title', 'Inicio')

@section('content')

<section class="content-header">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Bienvenido <i>{{ auth()->user()->last_name }} {{ auth()->user()->first_name }}</i></div>
          </div>
      </div>
  </div>
</section>
<br>
@if(auth()->user()->employe == true)
<div class="content">
  <div class="clearfix"></div>
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">

      <div class="panel panel-default">

        <div class="panel panel-heading">
          <h1 class="panel-title"><div class="text-center">Marcacion<div></h1>
        </div>

        <div class="panel panel-body">
          {!! Form::open(['route' => 'marcaciones.store', 'id'=> 'marcacions-form']) !!}
          <meta name="csrf-token" content="{{ csrf_token() }}" />
          @include('flash::message')
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $message)
                          <li>{{ $message }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          {{ csrf_field() }}

              <div class="row">
                <div class="col-md-8 col-md-offset-2">

                  {!! Form::hidden('latitud', null, ['class' => 'form-control']) !!}
                  <!-- Longitud Field -->
                  {!! Form::hidden('longitud', null, ['class' => 'form-control']) !!}
                  <!-- Longitud Field -->
                  {!! Form::hidden('ip', null, ['disabled'=> 'disabled', 'id'=> 'ip', 'class' => 'form-control']) !!}


                  <div class="form-group col-sm-12">
                    {!! Form::label('id_tp_marcacion', 'Tipo de Marcacion:') !!}
                    {!! Form::select('id_tp_marcacion', $tpmarcacion, null,['id'=>'id_tp_marcacion', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
                  </div>

                  <div class="form-group col-sm-12">
                    {!! Form::label('observacion', 'Observacion:') !!}
                    {!! Form::textarea('observacion', null, ['class' => 'form-control',  'rows' => 4, 'cols' => 54,]) !!}
                  </div>

                  <br>
                  <div class="form-group col-sm-12">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-block btnSend']) !!}
                  </div>


                </div>
              </div>
              {!! Form::close() !!}


            </form>

          </div>

      </div>
    </div>
  </div>

</div>
@endif

@endsection

@section('js')
<script src="{{ asset('js/marcacions/create.js')}} "></script>
@endsection
