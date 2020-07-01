$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function(){
  var f = new Date();

  $('.select2').select2();

  $("#myform").validate({
    rules: {
      first_name:  {  minlength: 2, lettersonly: true },
      last_name:   {  minlength: 4, lettersonly: true },
      ndocumento:  {  minlength: 6, number: true },
      employe:     {  required: true, },
      phone:       {  minlength: 10 },
      email:       {  email: true },
      country:     {  required: true },
      'id_rol[]':  {  required: true, },
      username:    {  required: true, minlength: 4, uniqueDB: true      },
      password:    {  required: true, minlength: 6  },
    },
    onkeyup :false,
    errorPlacement : function(error, element) {
     $(element).closest('.form-group').find('.help-block').html(error.html());
     },
     highlight : function(element) {
     $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     unhighlight: function(element, errorClass, validClass) {
     $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
     $(element).closest('.form-group').find('.help-block').html('');
     },
     submitHandler: function(form) {
        alertify.confirm('Registrado', 'Confirma que desea realizar el siguiente registro!', function(){
          form.submit(); },function(){  }).set({labels:{ok:'Guardar', cancel: 'Cancelar'}, padding: false});


   }


  });

});


jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[ a-zA-Záéíóúüñ]*$/i.test(value);
}, "Este campo solo permite datos alfabeticos");

$( "#username"  ).on('change', function() {
  $.ajax({
    type: "POST",
    url: "/validUser",
    dataType: "text",
    data: { username: this.value },
    success: function (data) {
      if(data > 0){
        $("#username").val('');
        $("#username").closest('.form-group').removeClass('has-success').addClass('has-error');
        $("#username").closest('.form-group').find('.help-block').html("Este documento de identidad ya se encuentra registrado.");
      }else{
        $("#username").closest('.form-group').removeClass('has-error').addClass('has-success');
        $("#telefono").closest('.form-group').removeClass('has-default').addClass('has-success');
        $("#username").closest('.form-group').find('.help-block').html('');
      }
    }
  });
});
$( "#ndocumento").on('change', function() {
  $.ajax({
         type: "POST",
         url: "/validUserDni",
         dataType: "text",
         data: { ndocumento : this.value },
         success: function (data) {
           if(data > 0){
             $("#ndocumento").val('');
             $("#ndocumento").closest('.form-group').removeClass('has-success').addClass('has-error');
             $("#ndocumento").closest('.form-group').find('.help-block').html("Este documento de identidad ya se encuentra registrado.");
           }else{
             $("#telefono").closest('.form-group').removeClass('has-error').addClass('has-success');
             $("#telefono").closest('.form-group').removeClass('has-default').addClass('has-success');
             $("#telefono").closest('.form-group').find('.help-block').html('');
           }

          }
     });
});



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

$.extend( $.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida.",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    dateISO: "Por favor, escribe una fecha (ISO) válida.",
    number: "Por favor, escribe un número válido.",
    digits: "Por favor, escribe sólo dígitos.",
    creditcard: "Por favor, escribe un número de tarjeta válido.",
    equalTo: "Por favor, escribe el mismo valor de nuevo.",
    extension: "Por favor, escribe un valor con una extensión aceptada.",
    maxlength: $.validator.format( "Por favor, no escribas más de {0} caracteres." ),
    minlength: $.validator.format( "Por favor, no escribas menos de {0} caracteres." ),
    rangelength: $.validator.format( "Por favor, escribe un valor entre {0} y {1} caracteres." ),
    range: $.validator.format( "Por favor, escribe un valor entre {0} y {1}." ),
    max: $.validator.format( "Por favor, escribe un valor menor o igual a {0}." ),
    min: $.validator.format( "Por favor, escribe un valor mayor o igual a {0}." ),
    nifES: "Por favor, escribe un NIF válido.",
    nieES: "Por favor, escribe un NIE válido.",
    cifES: "Por favor, escribe un CIF válido.",
});



// $.validator.addMethod('passwordCheck', function(value, element) {
//   var regex = /^[A-Za-z\d$@$!%*?&]{6,8}$/;
//   var val   = regex.test(value);
//   return this.optional(element) || val;
// }, '- Minimo 6 caracteres <br> - Maximo 8 <br> - Al menos una letra mayúscula <br> - Al menos una letra minucula <br> - Al menos un dígito <br> - No espacios en blanco <br> - Al menos 1 caracter especial');
