$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });


$(document).ready(function() {


  //RANGO DE FECHA
  $('#daterange' ).daterangepicker({
    "autoUpdateInput" : false,
    "ranges"   : {
      'Hoy'         : [moment(), moment()],
      'Ayer'        : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Hace 7 Dias' : [moment().subtract(6, 'days'), moment()],
      'Hace 30 Dias': [moment().subtract(29, 'days'), moment()],
      'Este Mes'    : [moment().startOf('month'), moment().endOf('month')],
      'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "locale"    : {
      "format": "YYYY-MM-DD",
      "separator": " - ",
      "applyLabel": "Guardar",
      "cancelLabel": "Cancelar",
      "fromLabel": "Desde",
      "toLabel": "Hasta",
      "customRangeLabel": "Personalizar",
      "daysOfWeek": [
        "Do",         "Lu",         "Ma",         "Mi",
        "Ju",         "Vi",         "Sa"
      ],
      "monthNames": [
        "Enero",      "Febrero",    "Marzo",      "Abril",
        "Mayo",       "Junio",      "Julio",      "Agosto",
        "Setiembre",  "Octubre",    "Noviembre",  "Diciembre"
      ],
      "firstDay": 1,
      "startDate": moment().subtract(29, 'days'),
      "endDate"  : moment()
   },
  }).on('apply.daterangepicker', function (e, picker) {
    $("#startDate").val(picker.startDate.format('DD-MM-YYYY'));
    $("#endDate").val(picker.endDate.format('DD-MM-YYYY'));
  });
  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM-DD-YYYY') + ' - ' + picker.endDate.format('MM-DD-YYYY'));
  });
  $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    $("#startDate").val('');
    $("#endDate").val('');
  });
  //RANGO DE FECHA


  $("#marcacionsReport-table").DataTable({
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
     }
  });
});

//BUSQUEDA DE DATOS
$("#search").unbind('click');
$("#search"  ).click(function() {


  if(  $('#startDate').val() == '' &&  $('#endDate').val() == ''){
    alert("¡Indica una fecha de búsqueda!");
    return false;
  }
  var formulario = $("#formMarcaciones").serializeObject();

  table = $('#marcacionsReport-table').DataTable({
        'ajax': {
          'url': "/reportSearch",
          'type':"POST",
          'data' :{formulario : formulario}
        },
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
        'responsive'  : false,
        'autoWidth'   : true,
        'destroy'     : true,
        'deferRender' : true,
        dom: 'lBfrtip',
        buttons: [
          {
            extend: 'excel',
            text :   'EXCEL',
            messageTop: null,
          },
          {
            extend: 'copy',
            text: 'Copiar',
          },
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          if( parseInt(aData.total_negativo) > 0 ){
            $('td', nRow).css('background-color', '#EA8080');
          }
          if( (aData.autorizado_entrada != null) || (aData.autorizado_salida != null) ){
            $('td', nRow).css('background-color', '#90EE90');
          }
        },
        'columns':[
           {data:"num"},
           {data:"nombre"},
           {data:"apellido"},
           {data:"fecha"},
           {data:"dia_letra"},
           {data:"entrada"},
           {data:"hora_inicio"},
           {data:"resto_entrada"},
           {data:"salida"},
           {data:"hora_salida"},
           {data:"resto_salida"},
           {data:"total_positivo"},
           {data:"total_negativo"},
           {data:"autorizado_entrada"},
           {data:"observacion_entrada"},
           {data:"autorizado_salida"},
           {data:"observacion_salida"},
           // {data:"status"},
         ]
    });

});
//BUSQUEDA DE DATOS


$("#clean" ).click(function() {
  $("#startDate").val('');
  $("#endDate").val('');
  $('input[name="daterange"]').val('');
  $('#id_empleado').val('').trigger('change');

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
