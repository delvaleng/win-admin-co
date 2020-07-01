<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistema interno de personal administrativo de WIN TECNOLOGIES INC S.A."/>
        <meta name="author" content="Diseño: Susana Piñero. Desarrollo: Gloribel Delgado." />
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>@yield('title')</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <!-- CSS del tema -->
        <link href="{{ asset('css/style-sb-ui-pro.css') }}" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <!-- FUENTES Oficiales -->
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <!-- CSS del tema personalizado -->
        <link href="{{ asset('css/style-index.css') }}" rel="stylesheet" />
        <!-- Iserta css personalizado de cada vista -->
        @yield('css')
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <!-- Integrción de HubSpot -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6883387.js"></script>
    <!-- FIN Integrción de HubSpot -->
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                    <div class="container">
                        <a class="navbar-brand text-primary" href="index.html">
                            <img src="{{ asset('/imagenes/logo.png') }}"alt="Logo WIN Perú">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <i class="fa fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}">{{ __('Iniciar sesión') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}">{{ __('Cerrar sesión') }}</a>
                                        </li>
                                    @endif
                                @else
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ url('/home') }}">{{ __('Panel Administrativo') }}</a>
                                  </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar sesión') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                <main role="main" id="main" class="section-main">
                @yield('content')
                </main>
            </div>
            <div class="svg-border-waves text-dark">
                <svg class="wave" style="pointer-events: none; bottom: auto;" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                    <defs>
                        <style>
                            .a {
                                fill: none;
                            }
                            .b {
                                clip-path: url(#a);
                            }
                            .d {
                                opacity: 0.5;
                                isolation: isolate;
                            }
                        </style>
                        <clippath id="a"><rect class="a" width="1920" height="75"></rect></clippath>
                    </defs>
                    <title>wave</title>
                    <g class="b"><path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path></g>
                    <g class="b"><path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path></g>
                    <g class="b"><path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path></g>
                    <g class="b"><path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path></g>
                </svg>
            </div>
            <div id="layoutDefault_footer">
                <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="footer-brand">WIN RIDESHARE</div>
                                <div class="mb-3">Validación de Conductor COLOMBIA</div>
                                <div class="icon-list-social mb-5">
                                    <a class="icon-list-social-link" href="https://www.instagram.com/win.tecnologies/?igshid=9smeb9ykslm7"><i class="fa fa-instagram"></i></a>
                                    <a class="icon-list-social-link" href="https://web.facebook.com/Win-Tecnologies-107937183898910/?_rdc=1&_rdr"><i class="fa fa-facebook-square"></i></a>
                                    <a class="icon-list-social-link" href="https://www.youtube.com/channel/UCHCWOH9Kizu91O0DgiLEZ3Q"><i class="fa fa-youtube"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                        <div class="text-uppercase-expanded text-xs mb-4">Países</div>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><a href="javascript:void(0);">Bolivia</a></li>
                                            <li class="mb-2"><a href="https://co.accionistas.winrides.com/">Colombia</a></li>
                                            <li class="mb-2"><a href="javascript:void(0);">Ecuador</a></li>
                                            <li class="mb-2"><a href="javascript:void(0);">México</a></li>
                                            <li class="mb-2"><a href="https://accionistas.wintecnologies.com/">Perú</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-5 mb-md-0">
                                        <div class="text-uppercase-expanded text-xs mb-4">Soporte</div>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><a href="https://help.wintecnologies.com/">Documentación</a></li>
                                            <li class="mb-2"><a href="https://comunidad.winrides.com/">Comunidad</a></li>
                                            <li class="mb-2"><a href="https://wintecnologies.com/soporte">Ticket de atención</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-8">
                                        <div class="text-uppercase-expanded text-xs mb-4">Nuestra oficina</div>
                                        <ul class="list-unstyled mb-0">
                                            <!-- <li class="mb-2">Nuestra oficina: Bogotá Cr 59D # 132 – 28</li> -->
                                            <li class="mb-2">Horario de Atención</li>
                                            <li class="mb-2">Lunes a Viernes: 8am - 5pm.</li>
                                            <li class="mb-2">Sábados:   8am - 1pm.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &copy; WIN RIDESHARE {{ date('Y') }} </div>
                            <div class="col-md-6 text-md-right small">
                                <a href="javascript:void(0);">Políticas de privacidad</a>
                                &middot;
                                <a href="javascript:void(0);">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/script-sb-ui-pro.js') }}"></script>
        <script src="{{ asset('js/script-sb-ui-pro_aos.js') }}"></script>
        <!-- Iserta js personalizado de cada vista -->
        @yield('js')
        <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
        </script>
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6883387.js"></script>
        <!-- End of HubSpot Embed Code -->
    </body>
</html>
