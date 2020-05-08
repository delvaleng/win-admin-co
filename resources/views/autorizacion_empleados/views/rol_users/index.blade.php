@extends('layouts.app')
@section('title', 'Rol Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
<style>
  th, td { white-space: nowrap; }
  div.dataTables_wrapper {
    margin: 0 auto;
  }
  div.container {
    width: 80%;
  }
  th { font-size: 12px; }
  td { font-size: 11px; }
  label { font-size: 12px; }
</style>
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Rol Usuarios</h1>
  <h1 class="pull-right">
    <a class="btn btn-registro btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('rol-usuarios.create') !!}">Agregar</a>
  </h1>
</section>
  <div class="content">
    <div class="clearfix"></div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="box box-primary">
      <div class="box-body">
        @include('panel.rol_users.table')
      </div>
    </div>
    <div class="text-center">
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/panel/rol_users/index.js')}} "></script>
@endsection
