@extends('layouts.app')
@section('title', 'Reportes')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>

@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Reporte de Marcaciones</h1>
</section>

<div class="clearfix"></div>
<div class="clearfix"></div>

<div class="content">
  <div class="clearfix"></div>
  <div class="box box-primary">

    <form id=formMarcaciones>

      <div class="box-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                  <label for="id_invited_by" class="control-label">Fecha</label>
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      {!! Form::text('daterange',   null, ['id'=>'daterange', 'class' => 'form-control']) !!}
                      {!! Form::hidden('startDate', null, ['id'=>'startDate', 'class' => 'form-control']) !!}
                      {!! Form::hidden('endDate',   null, ['id'=>'endDate', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>


            <div class="col-sm-6">
              <div class="form-group">
                <label for="year" class="control-label">Empleado</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                  {!! Form::select('id_empleado', $tpempleado, null,['id'=>'id_empleado', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
                </div>
                <div><span class="help-block" id="error"></span></div>
              </div>
            </div>

          </div>
      </div>

      <div class="box-footer">
        <button type="button" class="btn btn-default" id="clean">Limpiar</button>
        <button type="button" class="btn btn-info pull-right" id="search">Buscar</button>
      </div>

    </form>

  </div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      @include('marcacions.table_report')
    </div>
    <div class="box-footer">
      <div class="form-group">
        <div class="col-xs-12">
          <label for="Datos">Leyenda:<br><br>
            <code>
              **H/Entrada: Hora oficial de entrada.<br>**H/Inicio: Hora de llegada del empleado.<br>
              **H/Salida: Hora oficial de salida.  <br>**H/Fin: Hora de salida del empleado.<br>
              **Min/Ttal(+): Minutos extras.       <br>**Min/Ttal(-): Minutos tarde.<br>
            </code>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center">
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
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- alertify -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<!-- enlace -->
<script src="{{ asset('js/marcacions/report.js')}} "></script>
@endsection
