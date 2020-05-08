@extends('layouts.app')
@section('title', 'Auditoria')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<style>
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
    <section class="content-header">
        <h1 class="pull-left">Auditoria</h1>
        <h1 class="pull-right">
          <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" onclick='buscar()'>Buscar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('auditoria.table')
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

<script src="{{ asset('js/auditoria/index.js')}} "></script>

@endsection
