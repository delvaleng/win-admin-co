<html>
  <head>
  </head>
  <body>
    <h3><b>Sr(a). {{ $nombre." ".$apellido }}</b></h3>

    <div align="justify">
      <p>¡Estamos muy emocionados de que hayas concluido tu registro en <b>Win</b> y con gusto te informamos que tu documentación fue validada con éxito y que sólo te encuentras a un paso de quedar activo en nuestra plataforma!<br>
      Nos interesa que nuestros conductores brinden un servicio de excelencia por lo cual es necesario que realices la siguiente prueba para certificarte como <b>Conductor Win</b>.<br>
      <b>Da clic en la siguiente liga para que comiences tu test.</b><br>
      <a href="{{ $link }}">Realizar test ahora!.</a><br>
      <br>
    </div>

    @include('layouts.msg_footer')

  </body>
</html>
