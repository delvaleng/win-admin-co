@extends('layouts.app')
@section('title', 'Ciudades')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Ciudades</h1>
  <h1 class="pull-right">
    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ciudades.create') !!}">+</a>
  </h1>
</section>

<div class="content">
  <div class="clearfix"></div>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      @include('cities.table')
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

  table = $('#cities-table').DataTable({
    'ajax': {
    'url' : "/getCities",
    'type':"POST",
    },
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
    "decimal"       : "",
    "emptyTable"    : "No hay información",
    "info"          : "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty"     : "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered"  : "(Filtrado de _MAX_ total entradas)",
    "infoPostFix"   : "",
    "thousands"     : ",",
    "lengthMenu"    : "Mostrar _MENU_ Entradas",
    "loadingRecords": "Cargando...",
    "processing"    : "Procesando...",
    "search"        : "Buscar:",
    "zeroRecords"   : "Sin resultados encontrados",
    "paginate"      : {
    "first"         : "Primero",
    "last"          : "Ultimo",
    "next"          : "Siguiente",
    "previous"      : "Anterior"
      }
     },
     'fixedColumns' : true,
     'columns' : [
       {data:"id",
       "render": function (data, type, row) {
         return '<div class="btn-group">'+
         '<a href="/ciudades/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
         '<a href="/ciudades/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
         '</div>';
       }},
         {data:"get_state_country",
         "render": function (data, type, row) {
          return (data) ? data[0].country_name : '-';
         }},
         {data:"get_state",
         "render": function (data, type, row) {
          return (data) ? data.state_name : '-';
         }},
         {data:"city_name",
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
          url: "/statusCities", //ESTO VARIA
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
