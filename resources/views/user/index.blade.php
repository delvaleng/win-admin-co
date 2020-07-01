@extends('layouts.app')
@section('title',  'Usuarios')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/ui-lightness/jquery-ui.css') }}">
<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Usuarios</h1>
  <h1 class="pull-right">
    <a class="btn btn-registro btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('user.create') !!}">Agregar</a>
  </h1>
</section>

<div class="content">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="clearfix"></div>
  @include('flash::message')
  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      @include('user.table')
    </div>
  </div>
  <div class="text-center">
  </div>
</div>


<div class="modal fade" id="modal-rol">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header"> Roles Usuario  </div>

      <div class="modal-body">
        <form method="POST"  id="updateRol">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {!! Form::hidden('id_userR', null,['id'=>'id_userR', 'class'=>'form-control'] ) !!}
        {{-- Inicio: Rol  --}}
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-cogs"></i>
              </div>
              {!! Form::select('id_rolU', $roles, null, ['id'=>'id_rolU', 'name'=>'id_rolU[]', 'class'=>'form-control select2', 'multiple'=>'multiple', 'style'=>'width: 100%'] ) !!}
            </div>
          </div>
        {{-- Fin:  Rol --}}
        <div class="box-body no-padding">
          <table id="rol" name="rol"  width="100%" align="left" class="table">
            <thead>
              <tr>
                <th align="center" width="auto">Menu</th>
                <th align="center" with="100px">Desglose</th>
                <th align="center" with="100px">Rol</th>
              </tr>
            </thead>
            <tbody id="rol_details"></tbody>
          </table>
        </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-SavedRol">Guardar</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal-permisos">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header"> Permisos Usuario </div>

      <div class="modal-body">
        <form method="POST"  id="updatePermiso">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {!! Form::hidden('id_userP', null,['id'=>'id_userP', 'class'=>'form-control'] ) !!}
        {!! Form::hidden('id_roluserp', null,['id'=>'id_roluserp', 'class'=>'form-control'] ) !!}
        {{-- Inicio: Permisos  --}}
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-unlock-alt"></i>
              </div>
                {!! Form::select('id_permisos', $permisos, null, ['id'=>'id_permisos', 'name'=>'id_permisos[]', 'class'=>'form-control select2', 'multiple'=>'multiple', 'style'=>'width: 100%'] ) !!}
            </div>
          </div>
        {{-- Fin:  Permisos --}}
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-SavedPermisos">Guardar</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal-show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {!! Form::hidden('id_user', null,['id'=>'id_user', 'class'=>'form-control'] ) !!}
          <table id="datos"  name="datos"   width="100%" align="left" class="compact">
            <tr>
              <td colspan="2" height="20px"><pre><i class="fa fa-user"></i> - <b>Datos Personales</b></pre></td>
            </tr>
            <tr>
              <th  width="40%" width="40%"><b>Apellido(s)/Nombre(s)</b></th>
              <td  width="60%" id="fullName"></td>
            </tr>
            <tr>
              <th  width="40%"><b>N&deg;Documento</b></th>
              <td  width="60%" id="dni"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Fecha/Nacimiento</b></th>
              <td  width="60%" id ="birthdate"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Tel&eacute;fono</b></th>
              <td  width="60%" id="phone"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Usuario</b></th>
              <td  width="60%" id="username"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Sexo</b></th>
              <td  width="60%" id="gender"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Pais</b></th>
              <td  width="60%" id="id_country"></td>
            </tr>
            <tr>
              <th  width="40%"><b>Dirección</b></th>
              <td  width="60%" id="address"></td>
            </tr>
          </table>
          <div id="id_rol"></div>
      </div><br>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal-passw">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header"> Cambio de Contraseña </div>
      <div class="modal-body">
        <div width="80%">
          <form method="POST"  id="updatePassw" name="updatePassw">
          <meta name="csrf-token" content="{{ csrf_token() }}">
          {!! Form::hidden('id', null,['id'=>'id', 'class'=>'form-control'] ) !!}
          <label for="Datos">Contraseña:</label>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                  <input type="password" id="password" name="password" class="form-control required"  placeholder="***********">
                    <div class="input-group-addon"><code>*</code></div>
                </div><div><span class="help-block" id="error"></span></div>
            </div>
          <label for="Datos">Observaciones:</label>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                  {!! Form::textarea('note', null,['id'=>'note', 'class'=>'form-control required', 'value'=> old('note'), 'rows'=>'2'] ) !!}
                </div><div><span class="help-block" id="error"></span></div>
              </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <input  type="button" class="btn btn-primary"  id ="sendPassw" value="Guardar" />
      </div>
    </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<!-- DataTable -->
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Buttons-1.5.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Buttons-1.5.2/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Buttons-1.5.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Buttons-1.5.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/AJAX/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/AJAX/pdfmake.min.js') }}"></script>

<!-- select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- alertify -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>

<script src="{{ asset('js/user/index.js')}} "></script>

@endsection
