@extends('layouts.app')
@section('title', 'Saldo Conductor')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('content')
    <section class="content-header">
      <h1 class="pull-left">Saldo Conductor</h1>
      <h1 class="pull-right">
        <a class="btn btn-registro btn-default" style="margin-top: -10px;margin-bottom: 5px" id="button-open-modal">Buqueda de Conductores</a>
      </h1>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content">
      <div class="clearfix"></div>
      <div class="clearfix"></div>

      <div class="box box-primary">

        @include('flash::message')

        <form id=formIndexSaldo>

          <div class="box-body">

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="country" class="control-label">Pais</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                    {!! Form::select('country_form', $country, null,['id'=>'country_form', 'class'=>'form-control select2', 'placeholder' => 'Seleccione un país...', 'style'=>'width: 100%'] ) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="codigo" class="control-label">Usuario</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                    {!! Form::text('usuario_form', null, ['id'=> 'usuario_form', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>
            </div>

          </div>

          <div class="box-footer">
          <button type="button" class="btn btn-clean btn-default" id="button-clean" >Limpiar</button>
          <button type="button" class="btn btn-search pull-right" id="button-search">Buscar</button>
        </div>

        </form>

      </div>

      <div class="clearfix"></div>
      <div class="box box-primary">
        <div class="box-body">
          @include('saldos.table')
        </div>
      </div>

    </div>


    <div class="modal fade in" id="modal-busqueda">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Busqueda de Conductor</h4>
          </div>

          <div class="modal-body">
            <div class="row busqueda">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="country" class="control-label">Pais</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                    {!! Form::select('country', $country, null,['id'=>'country', 'class'=>'form-control select2', 'placeholder' => 'Seleccione un país...', 'style'=>'width: 100%'] ) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="codigo" class="control-label">Usuario/Correo Electr&oacute;nico</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                    {!! Form::text('llave', null, ['id'=> 'llave', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>
              <div class="col-sm-12" align="center"><div class="waiting_busqueda"></div></div>

            </div>

            <div class="row datos" style="display:none">
              <div class="col-sm-12" align="center">

                <div class="container-fluid">
                  <div class="row  text-center" style="padding-top:10px;">
                      <strong class="font-app">Su saldo es:</strong>
                  </div>
                  <div class="row  text-center" style="padding:3px;">
                      <h1><strong class="font-app" id="simbolo_moneda"></strong> <strong class="font-app" id="saldo_modal"></strong></h1>
                  </div>
                </div>

                <div class="container-fluid">
                  <div class="row  text-center" style="padding-top:10px;">
                      # <strong class="font-app" id="id_office_driver"></strong>
                  </div>
                  <div class="row  text-center" >
                      <strong class="font-app"> Datos del Conductor </strong>
                  </div>
                  <div class="row  text-center" >
                      <strong class="font-app" v-html="$store.state.first_name"></strong> <strong class="font-app" id="nombre_conductor"></strong>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary busqueda" id="button-search-api"                       >Buscar</button>
            <button type="button" class="btn btn-primary datos"    id="button-search-table" style="display:none">Sincronizar</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade in" id="modal-perfil">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Detalles de Conductor</h4>
          </div>

          <div class="modal-body">

            <div class="row">
              <div class="col-sm-12  col-sm-12" align="center"><div class="waiting_perfil"></div></div>
            </div>

            <div class="row perfil" style="display:none">

              <div class="col-xs-12 col-sm-3 center">
                <!-- Foto -->
                <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
                  <img src="{{ asset('imagenes/usuario.png') }}" width="120px" height="120px" class="img-circle" alt=""><br><br><br>
                </div>
              </div>
              <div class="col-xs-12 col-sm-9">

                <!-- Nombre -->
                <h4 class="blue"><span class="middle"> <label class="nombres_html"></label>, <label class="apellidos_html"></label> </span></h4>
                <div class="profile-user-info">

                  <!-- E-mail -->
                  <div class="profile-info-row">
                    <div class="profile-info-name"> E-mail </div>
                    <div class="profile-info-value">
                      <span><label class="email_html"></label></span>
                    </div>
                  </div>
                  <!-- Telefono -->
                  <div class="profile-info-row">
                    <div class="profile-info-name"> Tel&eacute;fono</div>
                    <div class="profile-info-value">
                      <span><label class="telefono_html"></label></span>
                    </div>
                  </div>
                  <!-- CODIGO -->
                  <div class="profile-info-row">
                    <div class="profile-info-name"> Codigo </div>
                    <div class="profile-info-value">
                      <span><label class="codigo_invitado_html"></label></span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/saldos/index.js')}} "></script>

@endsection
