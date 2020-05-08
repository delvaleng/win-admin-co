
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WIN | COLOMBIA</title>

        <!-- Fonts -->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Bootstrap 3.3.7 -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{  asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{  asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{  asset('css/style.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
      @if (Route::has('login'))
          <div class="top-right links">
              @auth
                  <a href="{{ url('/home') }}">Inicio</a>
              @else
                  <a href="{{ route('login') }}">Iniciar Sesión</a>
              @endauth
          </div>
      @endif
      <div id="LoginForm">
        <div class="container">
            <h1 class="form-heading"></h1>
            <div class="login-form">
            <p>
              <div class="main-div">
                <div class="panel"><h2>WIN | Colombia<br></h2></div>

                  <div class="content">
                    @include('flash::message')
                      {!! Form::open(['route' => 'marcacions.store', 'id'=> 'marcacions-form']) !!}

                        <!-- Id Empleado Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('id_empleado', 'Empleado:') !!}
                            {!! Form::select('id_empleado', $empleado, null,['id'=>'id_empleado', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
                        </div>

                        <!-- Id Tp Document Ident Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('id_tp_marcacion', 'Tipo de Marcacion:') !!}
                            {!! Form::select('id_tp_marcacion', $tpmarcacion, null,['id'=>'id_tp_marcacion', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
                            <!-- {!! Form::text('id_tp_document_ident', null, ['class' => 'form-control']) !!} -->
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('password', 'Contraseña:') !!}
                            <input type="password" class="form-control" id="password"  name="password" placeholder="Contraseña">
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('observacion', 'Observacion:') !!}
                            {!! Form::text('observacion', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Latitud Field -->
                        <div class="form-group col-sm-6">
                          <!-- {!! Form::label('latitud', 'Latitud:') !!} -->
                          {!! Form::hidden('latitud', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Longitud Field -->
                        <div class="form-group col-sm-6">
                          <!-- {!! Form::label('longitud', 'Longitud:') !!} -->
                          {!! Form::hidden('longitud', null, ['class' => 'form-control']) !!}


                        </div>

                        <!-- Longitud Field -->
                        <div class="form-group col-sm-6">
                          <!-- {!! Form::label('ip', 'IP:') !!} -->
                          {!! Form::hidden('ip', null, ['disabled'=> 'disabled', 'id'=> 'ip', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btnSend']) !!}
                        </div>

                      {!! Form::close() !!}

                  </div>

                  <!-- <div id="mapcanvas" style="width:400px; height:400px"></div> -->

              </div>
              </div>
            </div>
        </div>
        <!-- jQuery 3.1.1 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAph1Y5uOO5kNkeZFzcy1odYf4ADNSOmng&callback=initMap" type="text/javascript"></script>

       <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script> -->
        <script src="{{ asset('js/marcacions/create.js')}} "></script>

    </body>
</html>
