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
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{  asset('css/style.css')}}" rel="stylesheet" type="text/css">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <title>@yield('title') | WIN-ADMIN-COL</title>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="/home">
          <div id="logo-backend" class="logo-backend"></div>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a id="sidebar-toggle-backend" href="#" class="sidebar-toggle-backend sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- This nav content the user data :-->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle dropdown-toggle-backend" data-toggle="dropdown">
                  <img src="{{ asset('dist/img/usuario.png')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs"> {{ auth()->user()->lastname }} {{ auth()->user()->name }} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('dist/img/usuario.png') }}" class="img-circle" alt="User Image">
                  </li>
                  <li class="user-footer">
                  <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div> -->
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Salir</a>
                      <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img src="{{ asset('dist/img/usuario.png') }}" class="img-circle" alt="User Image"></div>
            <div class="pull-left info"><p>{{ auth()->user()->username }}</p></div>
          </div>
          {!!html_entity_decode($main) !!}
        </section>
      </aside>
      <div class="content-wrapper">
          @yield('content')
      </div>
      <footer class="main-footer" align="center">
        <span>Copyright © {{ date('Y') }} - WIN TECNOLOGIES INC S.A.<br>Todos los derechos reservados</span>
      </footer>
    </div>
sw -->
    <!--<script src="http://192.168.0.147:5555/mobile-detect.min.js"></script>-->

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/js/myJs.js') }}"></script>

      @yield('js')
      <script>
      $('div.alert').not('.alert-important').delay(6000).fadeOut(350);
      </script>
  </body>
</html>
