@extends('layouts.app')
@section('title',  $title)
@section('css')

<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/ui-lightness/jquery-ui.css') }}">
<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


<style>
  .btn-circle {
    width: 25px;
    height: 25px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
  }
  .btn2.btn-default  {background:transparent,  border-color: #252d3d !important;}
  .btn2.btn2-primary {background-color: #08426a !important;  border-color: #252d3d !important; color : #fff !important}
  th, td { white-space: nowrap; }
  div.dataTables_wrapper {
    margin: 0 auto;
  }
  div.container {
    width: 80%;
  }
  th { font-size: 12px; }
  td { font-size: 11px; }
  label { font-size: 12px; }
</style>
@endsection

@section('content')
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Listado de Usuarios</h3>
      </div>
      <div class="box-body">
        <div class="hero-callout">
          <table id="users" name="users"  class="stripe row-border order-column compact" style="width:100%">
            <thead>
              <tr>
    					 <th align="center" width="auto" >Accion</th>
    					 <th align="center" width="auto" >USUARIO</th>
               <th align="center" width="auto" >Nombres</th>
               <th align="center" width="auto" >Tel&eacute;fono</th>
               <th align="center" width="auto" >Correo</th>
    					 <th align="center" width="auto" >Pais</th>
    					 <th align="center" width="auto" >Usuario</th>
               <th align="center" width="auto" >Estatus</th>
             </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
             <tr>
    					 <th align="center" width="auto" >Accion</th>
               <th align="center" width="auto" >USUARIO</th>
               <th align="center" width="auto" >Nombres</th>
               <th align="center" width="auto" >Tel&eacute;fono</th>
               <th align="center" width="auto" >Correo</th>
    					 <th align="center" width="auto" >Pais</th>
    					 <th align="center" width="auto" >Usuario</th>
               <th align="center" width="auto" >Estatus</th>
             </tr>
            </tfoot>
          </table>
        </div>
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
                  <th  width="40%"><b>CURP</b></th>
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

  </section>
  <!-- /.content -->

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

<script src="{{ asset('js/User/index.js')}} "></script>

@endsection
