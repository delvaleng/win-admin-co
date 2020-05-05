$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var dataConductor;

$(document).ready(function() {

  var table;
  table = $('#saldo-table').dataTable({
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
  table = $('#saldo-table').DataTable({
      'ajax': {
        'url': "/getDataSaldo",
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
        { targets: [0], width: 20},
        { targets: [1], width: 40},
        { targets: [2], width: 80},
        { targets: [3], width: 20},
        { targets: [4,5,6], width: 100},
        { targets: [7], width: 20},

        { targets: [0,1,2,6,7], "className": "dt-center"},
        { targets:  [3,4,5],    "className": "dt-right" }
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
       {data: "id",
       "render": function (data, type, row) {
         return '<a id="button-perfil" data-id='+data+'" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>';
       }},
       {data: "usuario_oficina",
       "render": function (data, type, row) {
         return (data)? data : '-';
       }},
       {data: "id_country",
       "render": function (data, type, row) {
         return (data)? row.get_country.country : '-';
       }},
       {data: "id_country",
       "render": function (data, type, row) {
         return (data)? row.get_country.conversion_monto : '-';
       }},
       {data: "id_country",
       "render": function (data, type, row) {
         if (data){
           if(row.saldo_actual > 0){
             var saldo = (row.saldo_actual)/row.get_country.conversion_monto;
             return row.get_country.simbolo_admitida+' '+saldo.toFixed(2);
           }
           else{
              var saldo = row.saldo_actual;
              return row.get_country.simbolo_admitida+' '+saldo;
           }
         }
       }},
       {data: "id_country",
       "render": function (data, type, row) {

         if (data){
          return row.get_country.simbolo_local+' '+row.saldo_actual;
           if(row.saldo_actual > 0){

           }
         }
       }},

       {data: "updated_at",
       "render": function (data, type, row) {
         return (data)?  data  : '-';
       }},
       {data:"status",
      "render": function (data, type, row) {
         return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ok-circle"></i><a>' :
         '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ban-circle"></i><a>';
      }},
      ]
    });

});

$("#button-clean" ).click(function(){

  $('#country_form').val('').trigger('change');
  $('#usuario_form').val('');


});

function estatusUpload(id) {

  $.ajax({
    url: "/updateStatusSaldo", //ESTO VARIA
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
//GESTION DE DATA

//GESTION DE BUSQUEDA
$("#button-open-modal"  ).click(function(){
  $('.datos'   ).hide();
  $('.busqueda').show();
  $("#country").val('');
  $("#llave"  ).val('');
  $('#modal-busqueda').modal('show');

});

$("#button-search-api"  ).click(function(){
  var pais  = $("#country").val();
  var llave = $("#llave").val();
  if (pais && llave){
    var pais  = $("#country").find('option:selected').text();

    $('.waiting_busqueda').html('<div class="loading"><img src="/imagenes/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');

    $.ajax({
      url: "/searchConductor",
      type:"post",
      data:{
        pais   :  pais,
        llave  :  llave
      },
      beforeSend: function () {    },
      }).done( function(d) {
        $('.waiting_busqueda').fadeIn(1000).html('');

        if(d.object == 'success'){
          $('.datos'   ).show();
          $('.busqueda').hide();
          alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t '+d.message+' </div>',
          function(){
            //clean
          });

          $("#simbolo_moneda"  ).html(d.data.simbolo_moneda);
          $("#saldo_modal"     ).html(d.data.saldo_actual);
          $("#id_office_driver").html(d.data.username);
          $("#nombre_conductor").html(d.data.first_name_driver+' '+d.data.last_name_driver);
          dataConductor = d.data;

          $('.datos'   ).show();
          $('.busqueda').hide();

        }else {
          alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t '+d.message+' </div>',
          function(){
            //clean
          });
        }
        // console.log(d);
      }).fail  ( function() {
        $('.waiting_busqueda').fadeIn(1000).html('');
        alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t Disculpe, no hemos podido procesar su solicitud </div>',
        function(){
          //clean
        });
    }).always  ( function() {       });




  }else{
    alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t Debes indicar los datos de busqueda! </div>',
    function(){
      //clean
    });
    return false;
  }
});

$("#button-search-table").click(function(){
  $('#modal-busqueda').modal('hide');
  // $("#id_driver_saldo_form").val(dataConductor.id_driver_saldo);
  $("#usuario_form").val(dataConductor.username);

  $("#button-search").click();
});

//GESTION DE BUSQUEDA

$('#saldo-table tbody' ).on('click','#button-perfil', function () {
  var id = $(this).attr("data-id");
  $('#modal-perfil').modal('show');

  $('.waiting_perfil').html('<div class="loading"><img src="/imagenes/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');

  setTimeout(function() {
    $('.waiting_perfil').fadeIn(1000).html('');
    $(".perfil").show();

  }, 3000);

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
