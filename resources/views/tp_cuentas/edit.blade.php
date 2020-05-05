@extends('layouts.app')
@section('title', 'Tipo de Cuenta')
@section('content')
    <section class="content-header">
        <h1>
            Tipo de Cuenta
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tpCuenta, ['route' => ['tp-cuentas.update', $tpCuenta->id], 'method' => 'patch']) !!}

                        @include('tp_cuentas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
