@extends('layout-simple')
@section('title', 'Inicio de sesión')
@section('content')
<div id="LoginForm">
  <div class="container">
      <h1 class="form-heading"></h1>
      <div class="login-form">
      <p><div class="main-div">
          <div class="panel"><h2>Bienvenidos<br></h2></div>
              <form id="Login" action="{{ url('login') }}" method="POST">
                {{ csrf_field() }}
                @if(Session::has('error_message'))
                <div class="alert alert-info">
                  {{ Session::get('error_message') }}
                </div>
                @endif
                <div class="form-group {{ $errors->has('username')? 'has-error' :'' }}">
                    <input id="username" name="username" placeholder="Usuario" class="form-control" type="text" value="{{ old('username') }}">
                    {!! $errors->first ('username', '<div class="error"><span class="help-block">:message</span></div>') !!}
                </div>
                <div class="form-group {{ $errors->has('password')? 'has-error' :'' }}">
                    <input id="password" type="password" name="password" placeholder="***********"  class="form-control">
                    {!! $errors->first ('password', '<div class="error"><span class="help-block">:message</span></div>') !!}
                </div>
                @if (session()->has('flash') )
                  <div class="alert alert-info">{{ session('flash')}}</div>
                @endif
                <div class="form-group {{ $errors->has('datos')? 'has-error' :'' }}">
                  {!! $errors->first ('datos', '<div class="error"><span class="help-block">:message</span></div>') !!}
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
