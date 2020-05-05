@extends('layouts.app')
@section('title', 'Estatus Recargas')
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
        <h1 class="pull-left">Estatus Recargas</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('estatus-recargas.create') !!}">+</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('status_recargas.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script>

  var table;

  table = $('#statusRecargas-table').DataTable({
       'responsive'  : false,
       'autoWidth'   : true,
       'destroy'     : true,
       'language': {
         'buttons': {
                copyTitle: 'Realizado exitosamente',
                copySuccess: {
                    _: '%d lineas copiadas',
                    1: '1 linea copiada'
                },
                pageLength: {
                 _: "Mostar %d Entradas",
                 '-1': "Tout afficher"
             }
              },
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
        },
     'fixedColumns' : true,
    });

</script>
@endsection
