@extends('layouts.app')
@section('title',  'Mi Perfil')
@section('css')
<!-- Agregando Datos- -->
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection

@section('content')
<div class="clearfix"></div>

<div class="content">
<div class="panel panel-default">

  <div class="panel panel-heading"><h1 class="panel-title">Mi Perfil | Detalles </h1></div>

  <div class="panel panel-body">

    <div class="user-detalle-view">
      <div class="row">

        <!-- col1 -->
        <div class="col-xs-12 col-sm-3 center">
          <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
            <img src="{{ asset('dist/img/usuario.png')}}" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
          </div>
        </div>

        <!-- col2 -->
        <div class="col-xs-12 col-sm-9">

          <!-- Nombre -->
          <h4 class="blue"><span class="middle"> {!! $user->first_name !!}, {!! $user->last_name !!} </span></h4>

          <div class="profile-user-info">

            <!-- Numero de Identidad -->
            <div class="profile-info-row">
              <div class="profile-info-name"> Documento/Identidad</div>
              <div class="profile-info-value"><span>{!! $user->ndocumento !!}</span></div>
            </div>
            <!-- Correo -->
            <div class="profile-info-row">
              <div class="profile-info-name">Correo/Electr&oacute;nico</div>
              <div class="profile-info-value"><span>{!! $user->email !!}</span></div>
            </div>

            <!--excel Usuario -->
            <div class="profile-info-row">
              <div class="profile-info-name"> Usuario </div>
              <div class="profile-info-value"><span>{!! $user->username !!}</span></div>
            </div>


            <!-- Telefono -->
            <div class="profile-info-row">
              <div class="profile-info-name"> Telefono</div>
              <div class="profile-info-value"><span>{!! $user->phone !!}</span></div>
            </div>

            <!-- Sexo -->
            <div class="profile-info-row">
              <div class="profile-info-name">Empleado</div>
              <div class="profile-info-value"><span>{!! ($user->employe == 'TRUE')?  'SI' : 'nO' !!}</span></div>
            </div>

            <!-- Direccion -->
            <div class="profile-info-row">
              <div class="profile-info-name"> Direcci&oacute;n </div>
              <div class="profile-info-value">
                <i class="fa fa-map-marker light-orange bigger-110"></i>
                <span>{!! ( $user->country_id)?  $user->getCountry->country_name : '-' !!}</span>
              </div>
            </div>

          </div><!-- /.col -->

        </div>

      </div>
    </div>
  </div>

</div>
</div>


@endsection

@section('js')
@endsection
