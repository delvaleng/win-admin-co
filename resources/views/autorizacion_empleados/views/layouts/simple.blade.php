<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">


    <!-- Agregando CSS -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')         }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')                              }}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTable/Buttons-1.5.2/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{  asset('css/style.css')}}" rel="stylesheet" type="text/css">
    @yield('css')
    <title>@yield('title') | WIN</title>
  </head>
  <body>
    <header class="overflow">
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <div class="logo"></div>
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav navbar-simple">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a id="dropdown-toggle-simple" href="#" class="dropdown-toggle flex" data-toggle="dropdown">
                <i class="material-icons md-light">menu</i>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Menu</span>
              </a>
              <ul class="dropdown-menu">
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="">
                  <div class="menu-link"><a href="/">Registro</a></div>
                  @if (Auth::guest())
                    <div class="menu-link"><a href="/login">Acceder</a></div>
                  @else
                    <div class="menu-link"><a href="/home">Panel</a></div>
                    <div class="menu-link"><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                      <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    </div>
                  @endif
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <main role="main" id="main" class="section-main" style="background-color : rgb(14, 27, 53);">
      @yield('content')
    </main>


  <footer class="page-footer font-small blue"><!-- Footer -->
  <div class="container-fluid text-md-left">
    <div class="row">
      <div class="col-sm-1 padding-footer">
      </div>

      <div class="col-sm-4 padding-footer"><!-- About company -->
        <h5 class="text-uppercase title-footer">Sobre Empresa</h5>
        <p>Empresa dedicada al desarrollo de la tecnología para facilitar las necesidades esenciales y los deseos de la humanidad.</p>
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

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/js/myJs.js') }}"></script>
@yield('js')
</body>
</html>
