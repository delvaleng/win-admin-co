<html>
  <head>
  </head>
  <body>
    <h3><b>Sr(a). {{ $nombre." ".$apellido }}</b></h3>
    <div align="justify">
      <p>¡Estamos muy contentos de que te hayas registrado para conducir con Win! Estamos aqu&iacute; para apoyarte en el proceso.<br>
      Te informamos que tu registro <b>NO</b> ha sido exitoso debido a:
      <br>
      <br>
      <b>&nbsp; &nbsp; &nbsp; **** {{ $motivo }} ***</b>
      <br>
      <br>
      Por lo que te invitamos a generar la carga de documentos descritos nuevamente en la siguiente liga: <br>
      Link: https://mx.conductores.wintecnologies.com , la cual ya se encuentra habilitada para hacer la correcci&oacute;n de tu perfil. </p>
    </div>
    @include('layouts.msg_footer')
  </body>
</html>
