@extends('layouts.app')
@section('title', 'Recargas Conductor')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<style>
  th, td { white-space: nowrap; }
  div.dataTables_wrapper {
    margin: 0 auto;
  }

  div.container {
    width: 80%;
  }
  th    { font-size: 12px; }
  td    { font-size: 11px; }
  label { font-size: 12px; }
  .btn3 {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  img.zoom {
      width: 350px;
      height: 200px;
      -webkit-transition: all .2s ease-in-out;
      -moz-transition: all .2s ease-in-out;
      -o-transition: all .2s ease-in-out;
      -ms-transition: all .2s ease-in-out;
  }

  .transition {
      -webkit-transform: scale(2.8);
      -moz-transform: scale(2.8);
      -o-transform: scale(2.8);
      transform: scale(2.8);
  }

</style>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Recargas Conductor
    <small> (Pendientes)</small>
  </h1>
  <h1 class="pull-right"></h1>
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

          <div class="col-sm-4">
            <div class="form-group">
              <label for="country" class="control-label">Pais</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dot-circle-o"></i></div>
                {!! Form::select('country_search', $country, null,['id'=>'country_search', 'class'=>'form-control select2', 'placeholder' => 'Seleccione un país...', 'style'=>'width: 100%'] ) !!}
              </div>
              <div><span class="help-block" id="error"></span></div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="country" class="control-label">Usuario</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dot-circle-o"></i></div>
                {!! Form::select('responsable_search', $responsable, null,['id'=>'responsable_search', 'class'=>'form-control select2', 'placeholder' => 'Seleccione un responsable...', 'style'=>'width: 100%'] ) !!}
              </div>
              <div><span class="help-block" id="error"></span></div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="country" class="control-label">Tipo de Banco</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dot-circle-o"></i></div>
                {!! Form::select('id_tp_banco_search', $tpbanco, null,['id'=>'id_tp_banco_search', 'class'=>'form-control select2', 'placeholder' => 'Seleccione forma de pago...', 'style'=>'width: 100%'] ) !!}
              </div>
              <div><span class="help-block" id="error"></span></div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label  class="control-label">Fecha de Recarga</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dot-circle-o"></i></div>
                {!! Form::text('daterange',   null, ['id'=>'daterange', 'class' => 'form-control']) !!}
                {!! Form::hidden('startDate', null, ['id'=>'startDate', 'class' => 'form-control']) !!}
                {!! Form::hidden('endDate',   null, ['id'=>'endDate', 'class' => 'form-control']) !!}
              </div>
              <div><span class="help-block" id="error"></span></div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label  class="control-label">Usuario</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                {!! Form::text('usuario_search', null, ['id'=> 'usuario_search', 'class' => 'form-control']) !!}
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
      @include('recargas.table')
    </div>
  </div>
</div>

<div class="modal fade in" id="modal-perfil">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                <div class="profile-info-name"> Usuario </div>
                <div class="profile-info-value">
                  <span><label class="usuario_invitado_html"></label></span>
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

<div class="modal fade in" id="modal-config">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Detalles de la Recarga</h4>
      </div>

      <div class="modal-body">
        <form id=formRecarga>

          {!! Form::hidden('id_driver_recarga', null, ['id'=>'id_driver_recarga', 'class' => 'form-control']) !!}
          {!! Form::hidden('status_config', null, ['id'=>'status_config', 'class' => 'form-control']) !!}

          <div class="row">
            <div class="col-sm-12  col-sm-12" align="center"><div class="waiting_config"></div></div>
          </div>

          <div class="row editar-recarga"  style="display:none">
            <div class="col-xs-12 col-md-12">
              <table class="table table-responsive" width="60%">
                <tr>
                  <td width='50%'>{!! Form::label('num_operacion_config', 'N&deg; Operaci&oacute;n:') !!}</td>
                  <td width='50%'><label id="num_operacion_config"></label></td>
                </tr>
              </table>
            </div>

            <!-- TIPO DE BANCO -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('id_tp_banco_config', 'Banco:') !!}
              {!! Form::select('id_tp_banco_config', $tpbanco, null,['id'=>'id_tp_banco_config', 'class'=>'form-control select2', 'placeholder' => 'Seleccione un banco...', 'style'=>'width: 100%'] ) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- OPERACION -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('num_comprobante_config', 'N&deg; Operaci&oacute;n:') !!}
              {!! Form::text('num_comprobante_config', null, ['class' => 'form-control']) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- FECHA DE PAGO -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('fecha_pago_config', 'Fecha de Pago:') !!}
              {!! Form::date('fecha_pago_config', null, ['class' => 'form-control']) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- HORA DE PAGO -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('hora_pago_config', 'Hora de Pago:') !!}
              {!! Form::time('hora_pago_config', null, ['class' => 'form-control']) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- TIPO DE PAGO -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('id_tp_pago_config', 'Tipo de Pago:') !!}
              {!! Form::select('id_tp_pago_config', $tppago, null,['id'=>'id_tp_pago_config', 'class'=>'form-control select2', 'placeholder' => 'Seleccione una pago...', 'style'=>'width: 100%'] ) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- MONTO -->
            <div class="form-group col-sm-6"><div class="input-group col-xs-12">
              {!! Form::label('saldo_recarga_config', 'Monto:') !!}
              {!! Form::text('saldo_recarga_config', null, ['class' => 'form-control']) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <!-- OBSERVACIONES -->
            <div class="form-group col-sm-12"><div class="input-group col-xs-12">
              {!! Form::label('observaciones_config', 'Observaciones:') !!}
              {!! Form::textarea('observaciones_config', null, ['class' => 'form-control',  'rows' => 4, 'cols' => 54,]) !!}
            </div><div><span class="help-block" id="error"></span></div></div>

            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="card" align="center">
                <img class="card-img-top" id="imagen_config_img" src="{{ asset('imagenes/noimage.png') }}"  style="width: 50%;height: 50%">
                <div class="card-body">
                  <label for="text">Vaucher Imagen</label><code>(*)</code>
                  <div class="form-group">
                    <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary btn-file radioD radioD">
                          Subir<input type='file' class="form-control" id="imagen_config" name="imagen_config" accept="image/x-png,image/gif,image/jpeg">
                        </span>
                      </label>
                      <input class="form-control" id="imagen_config_cap" data-new=true  readonly="readonly" name="imagen_config_cap" type="text" value="">
                      <!-- <span class="input-group-addon"><a class="help" data-id="imagen_config"><i class="fa fa-question-circle"></i></a></span> -->
                    </div>
                    <div><span class="help-block" id="error"></span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2"></div>

            <div class="form-group col-sm-12">

              <div class="col-md-4">
                <button type="button" data-status="3" class="btn3 btn-danger btn-block sendDataRecarga">
                  RECHAZAR
                </button>
              </div>

              <div class="col-md-4">
                <button type="button" data-status="2" class="btn3 btn-warning btn-block sendDataRecarga">
                  BLOQUEAR
                </button>
              </div>

              <div class="col-md-4">
                <button type="button" data-status="4" class="btn3 btn-success btn-block sendDataRecarga">
                  APROBAR
                </button>
              </div>

            </div>

          </div>

          <div class="row ver-recarga"     style="display:none">

            <div class="col-xs-12 col-md-12">
              @include('recargas.ver_recarga_modal')
            </div>

            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="card" align="center">
                <img  id="imagen_recarga"  class="zoom"  src="{{ asset('imagenes/noimage.png') }}" style="width: 50%;height: 50%">
              </div>
            </div>
            <div class="col-sm-1"></div>

          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary ver-recarga"       id="button-editar-recarga" style="display:none">Editar</button>
        <button type="button" class="btn btn-primary editar-recarga"    id="button-ver-recarga"    style="display:none">Cancelar</button>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('js')
<!-- <script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script> -->
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
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
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- alertify -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/recargas/pendientes.js')}} "></script>
@endsection
