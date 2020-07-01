$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {

  table = $('#autorizacionEmpleados-table').DataTable({
           'responsive'  : false,
           'autoWidth'   : true,
           'destroy'     : true,
           'deferRender' : true,
           'language': {
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
            }
          });

});

$("#search"  ).click(function() {

    table = $('#autorizacionEmpleados-table').removeAttr('width').DataTable({
            'ajax': {
              'url': "/getAutorizaciones",
              'type':"POST",
            },
            'responsive'    : false,
            'destroy'       : true,
            'language': {
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
            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/marcaciones-autorizaciones/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
                '</div>';
              }},
              {data:"get_empleado",
              "render": function (data, type, row) {
               return (data) ? data[0].first_name+' '+data[0].last_name : '-';
              }},
              {data:"marcacion",
              "render": function (data, type, row) {
               if(data) {
                 var today = new Date(data.dia);
                 var dd = today.getDate();
                 var mm = today.getMonth()+1; //January is 0!
                 var yyyy = today.getFullYear();
                 if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
                 var today = dd+'-'+mm+'-'+yyyy;
                 return today;
               }
                 else{
                   return  '-';
                 }
                 return (data)? data : '-';

              }},
              {data:"get_tp_marcacion",
              "render": function (data, type, row) {
               return (data) ? data[0].descripcion : '-';
              }},
              {data:"aprobado_by",
              "render": function (data, type, row) {
               return (data) ? data.username : '-';
              }},
              {data:"creado_by",
              "render": function (data, type, row) {
                return (data) ? data.username : '-';
              }},
              {data:"observacion",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
            ],
          });
});



//GET ARRAY FORM
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
