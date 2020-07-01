@extends('layouts.app')
@section('title', 'Departamentos')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/datatables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/table-small.css') }}"/>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Estados</h1>
  <h1 class="pull-right">
    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('departamentos.create') !!}">+</a>
  </h1>
</section>

<div class="content">
  <div class="clearfix"></div>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      @include('states.table')
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

  table = $('#states-table').DataTable({
    'ajax': {
    'url' : "/getState",
    'type':"POST",
    },
    'responsive' : false,
    'autoWidth'  : false,
    'destroy'    : true,
    'language'   : {
    'buttons'    : {
      copyTitle  : 'Realizado exitosamente',
      copySuccess: {
      _: '%d lineas copiadas',
      1: '1 linea copiada'
    },
      pageLength: {
      _: "Mostar %d Entradas",
      '-1': "Tout afficher"
      }
    },
      "decimal"        : "",
      "emptyTable"     : "No hay información",
      "info"           : "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty"      : "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered"   : "(Filtrado de _MAX_ total entradas)",
      "infoPostFix"    : "",
      "thousands"      : ",",
      "lengthMenu"     : "Mostrar _MENU_ Entradas",
      "loadingRecords" : "Cargando...",
      "processing"     : "Procesando...",
      "search"         : "Buscar:",
      "zeroRecords"    : "Sin resultados encontrados",
      "paginate"     : {
        "first"   : "Primero",
        "last"    : "Ultimo",
        "next"    : "Siguiente",
        "previous": "Anterior"
       }
    },
       'fixedColumns' : true,

         'columns' : [
             {data:"id",
             "render": function (data, type, row) {
               return '<div class="btn-group">'+
               '<a href="/departamentos/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
               '<a href="/departamentos/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
               '</div>';
             }},
             {data:"get_country",
             "render": function (data, type, row) {
              return (data) ? data.country_name : '-';
             }},
             {data:"state_name",
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
          url: "/statusEstados", //ESTO VARIA
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
