@extends('layouts.app')
@section('title', 'Menú')

@section('css')

@endsection

@section('content')
<section class="content-header">
  <h1>
    Men&uacute;
  </h1>
</section>
  <div class="content">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'patch' , 'id'=>'formEditMenus']) !!}
            @include('menus.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/menus/edit.js')}} "></script>
@endsection
