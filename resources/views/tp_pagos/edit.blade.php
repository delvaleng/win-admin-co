@extends('layouts.app')
@section('title', 'Tipo de Pago')
@section('content')
    <section class="content-header">
        <h1>
            Tipo de Pago
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tpPago, ['route' => ['tp-pagos.update', $tpPago->id], 'method' => 'patch']) !!}

                        @include('tp_pagos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
