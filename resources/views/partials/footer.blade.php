<footer class="page-footer font-small blue"><!-- Footer -->
<div class="container-fluid text-md-left">
  <div class="row">
    <div class="col-sm-1 padding-footer">
    </div>

    <div class="col-sm-4 padding-footer"><!-- About company -->
      <h5 class="text-uppercase title-footer">Sobre Empresa</h5>
      <p>Empresa dedicada al desarrollo de la tecnolog&iacute;a para facilitar las necesidades esenciales y los deseos de la humanidad.</p>
    </div>
      <div class="col-sm-2 padding-footer">
      <!-- $ RRSS -->
      <!-- <h5 class="text-uppercase title-footer">Redes Sociales</h5>
      <ul class="list-unstyled">
      <li>
      <i class="fa fa-facebook-official fa-2x"></i>
      <a href="#!" class="link-footer">Facebook</a>
      </li>
      <li>
      <i class="fa fa-youtube-square fa-2x"></i>
      <a href="#!" class="link-footer">Youtube</a>
      </li>
      </ul> -->
      </div>

    <!-- Copyright -->
    <div class="col-sm-4 padding-footer">
      <!-- Contact -->
      <div class="row">
        <h5 class="col-md-12 text-uppercase title-footer">Contáctanos</h5>
        <p class="col-xs-12">soporte.mx@winhold.net<br>
          WhatsApp: (+52) 614 467 4821<br>
          Contacta a tu embajador WIN
        </p>
      </div>
    </div>
  </div>
</div>
<div class="footer-copyright text-center py-3 copy"> Todos los Derechos Reservados  © {{date("Y")}} Copyright: WIN TECNOLOGIES INC S.A.</div>
</footer><!-- End Footer -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('/js/myJs.js') }}"></script>
  @yield('js')
  </body>
</html>
