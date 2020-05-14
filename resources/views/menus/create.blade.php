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
        {!! Form::open(['route' => 'menus.store' , 'id'=>'formCreateMenus']) !!}
          @include('menus.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/menus/create.js')}} "></script>
@endsection
