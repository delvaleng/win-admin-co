@extends('layouts.app')
@section('title', 'País')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">
    Pa&iacute;s
  </h1>
  <h1 class="pull-right">
    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pais.create') !!}">+</a>
  </h1>
</section>

<div class="content">
  <div class="clearfix"></div>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      @include('countries.table')
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

  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  var table;


    table = $('#countries-table').DataTable({
      'ajax': {
        'url': "/getCountries",
        'type':"POST",
      },
     'responsive'  : false,
     'autoWidth'   : true,
     'destroy'     : true,
     'language'    : {
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
     'columns' : [
         {data:"id",
         "render": function (data, type, row) {
           return '<div class="btn-group">'+
           '<a href="/pais/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
           '<a href="/pais/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
           '</div>';
         }},
         {data:"country_name",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"area_code",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"code",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"national_currency",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"foreign_currency",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"national_symbol",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"foreign_symbol",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"convert_mount",
         "render": function (data, type, row) {
          return (data) ? data : '-';
         }},
         {data:"status",
        "render": function (data, type, row) {
           return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ok-circle"></i><a>' :
           '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ban-circle"></i><a>';
       }},
     ],
      });

      function estatusUpload(id) {

        $.ajax({
          url: "/statusCountries", //ESTO VARIA
          type:"post",
          data:{
            id : id
          },
          beforeSend: function () {    },
          }).done( function(d) {
            if(d.object == 'success'){
              table.ajax.reload();
            }
          }).fail  ( function() { alert("Ha ocurrido un error en la operación");
          }).always( function() {       });
      }

</script>
@endsection
