$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var dataConductor;
var state = true;

$(document).ready(function() {


  $('.zoom').hover(function() {
    $(this).addClass('transition');
  }, function() {
    $(this).removeClass('transition');
  });


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

  var table;
  table = $('#recargas-table').dataTable({
      'responsive'  : true,
      'autoWidth': false,
      'destroy'   : true,
      'responsive'  : true,
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
    });

});

//GESTION DE DATA
$("#button-search").click(function(){

  var formulario = $("#formIndexSaldo").serializeObject();
  table = $('#recargas-table').DataTable({
      'ajax': {
        'url': "/getDataGenerales",
        'type':"POST",
        'data' :{formulario : formulario}
      },
      'responsive'  : false,
      'autoWidth'   : true,
      'destroy'     : true,
      'language'    : {
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
      'columnDefs'  : [
        { targets:  [9],         "className": "dt-center" },
        { targets:  [12,13,14],  "className": "dt-right" },
      ],
      'dom'         : 'lBfrtip',
      'buttons'     : [
        {
          extend: 'excel',
          text :   'EXCEL',
          messageTop: null,
          exportOptions: {
         }

        },
        {
          extend: 'copy',
          text: 'Copiar',
          exportOptions: {
         }
        },
      ],
      'columns'     : [
       {data: "id_driver_recarga",
       "render": function (data, type, row) {
         var button;
         button=  '<a id="button-perfil" data-id_enlace="'+row.id_enlace_conductor+'" data-pais="'+row.country+'" class="btn btn-default btn-xs"><i class="fa fa-user"></i></a>';
         button+= '&nbsp;&nbsp;&nbsp;'+
                  '<a id="button-config" data-id="'+data+'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>';
         return button;

       }},
       {data: "num_operacion",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "usuario_oficina",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "country",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "tp_banco",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "tp_pago",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "fecha_pago",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "hora_pago",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "status_recarga",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data:"status",
       "render": function (data, type, row) {
         return data;
       }},
       {data: "responsable",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "moneda_local",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "saldo_previo",
       "render": function (data, type, row) {
         return (data)? row.simbolo_local+'. '+data : '-';
       }},
       {data: "saldo_recarga",
       "render": function (data, type, row) {
         return (data)? row.simbolo_local+'. '+data : '-';
       }},
       {data: "saldo_final",
       "render": function (data, type, row) {
         return (data)? row.simbolo_local+'. '+data : '-';
       }},
    ]
    });

});

$("#button-clean" ).click(function(){

  $('#country_search'      ).val('').trigger('change');
  $('#responsable_search'  ).val('').trigger('change');
  $('#status_recarga_form' ).val('').trigger('change');
  $('#status_search'       ).val('').trigger('change');
  $('#id_tp_banco_search'  ).val('').trigger('change');
  $('#id_tp_pago_search'   ).val('').trigger('change');


  $("#startDate").val('');
  $("#endDate").val('');
  $('input[name="daterange"]').val('');

  $('#usuario_search').val('');


});
//GESTION DE DATA

//VER PERFIL MODAL
$('#recargas-table tbody' ).on('click','#button-perfil', function () {

  var id_enlace = $(this).attr("data-id_enlace");
  var pais      = $(this).attr("data-pais");
  getDataConductor(id_enlace, pais);

});

//VER RECARGA MODAL
$('#recargas-table tbody' ).on('click','#button-config', function () {

  var id = $(this).attr("data-id");
  $("#id_driver_recarga").val(id);
  getDataRecarga(id);

});



function getDataRecarga(id_driver_recarga){

  $('#modal-config'  ).modal('show');
  $('.waiting_config').html('<div class="loading"><img src="/imagenes/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
  $(".editar-recarga").hide();
  $(".ver-recarga"   ).hide();

  $.ajax({
    url: "/getDataRecargaId",
    type:"post",
    data:{
      id_driver_recarga   :  id_driver_recarga,
    },
    beforeSend: function () {    },
    }).done( function(d) {

      if(d.object == 'success'){
        setTimeout(function() {
          $('.waiting_config').fadeIn(1000).html('');
          $(".ver-recarga").show();
        }, 1000);
        
        $("#num_operacion_recarga"  ).html((d.data.num_operacion  )? d.data.num_operacion   : '-');
        $("#observaciones_recarga"  ).html((d.data.observacion )? d.data.observacion   : '-');


        $("#id_tp_banco_recarga"    ).html((d.data.tp_banco       )? d.data.tp_banco        : null);
        $("#num_comprobante_recarga").html((d.data.num_comprobante)? d.data.num_comprobante : null);
        $("#fecha_pago_recarga"     ).html((d.data.fecha_pago     )? d.data.fecha_pago      : null);
        $("#hora_pago_recarga"      ).html((d.data.hora_pago      )? d.data.hora_pago       : null);
        $("#id_tp_pago_recarga"     ).html((d.data.tp_pago        )? d.data.tp_pago         : null);
        $("#status_recarga"         ).html((d.data.status         )? d.data.status          : 0.00);
        $("#saldo_recarga_recarga"  ).html((d.data.saldo_recarga  )? d.data.saldo_recarga   : 0.00);
        if(d.data.id_tp_pago != 3){
          $(".imagen_vaucher").show();
          $('#imagen_recarga'         ).attr('src', (d.data.imagen  )? d.data.imagen          : '/imagenes/noimage.png');
        }else{
          $(".imagen_vaucher").hide();
        }

      }else {
        alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t '+d.message+' </div>',
        function(){
          //clean
        });
        $('#modal-config'  ).modal('hide');
      }
      // console.log(d);
    }).fail  ( function() {
      alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t Disculpe, no hemos podido procesar su solicitud </div>',
      function(){
        //clean
      });
      $('#modal-config'  ).modal('hide');
  }).always  ( function() {       });

}


function getDataConductor(id_enlace, pais){

  $(".perfil").hide();
  $('#modal-perfil').modal('show');
  $('.waiting_perfil').fadeIn(1000).html('');
  $('.waiting_perfil').html('<div class="loading"><img src="/imagenes/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');

  $.ajax({
    url: "/getDataConductorId",
    type:"post",
    data:{
      id_enlace  : id_enlace,
      pais       : pais
    },
    beforeSend: function () {    },
    }).done( function(d) {

      if(d.object == 'success'){
        setTimeout(function() {
          $('.waiting_perfil').fadeIn(1000).html('');
          $(".perfil").show();
        }, 1000);

        $(".nombres_html"        ).html((d.data.first_name)? d.data.first_name  : null);
        $(".apellidos_html"      ).html((d.data.last_name )? d.data.last_name   : null);
        $(".email_html"          ).html((d.data.email     )? d.data.email       : null);
        $(".telefono_html"       ).html((d.data.phone     )? d.data.phone       : null);
        $(".usuario_invitado_html").html((d.data.username )? d.data.username    : null);

      }else {
        alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t '+d.message+' </div>',
        function(){
          //clean
        });
        $('#modal-perfil'  ).modal('hide');
      }
      // console.log(d);
    }).fail  ( function() {
      alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t Disculpe, no hemos podido procesar su solicitud </div>',
      function(){
        //clean
      });
      $('#modal-perfil'  ).modal('hide');
  }).always  ( function() {       });

}

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
