@extends('layouts.app')
@section('title', 'Tipos de Marcaciones')
@section('content')
    <section class="content-header">
        <h1>
            Tipos de Marcaciones
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tpMarcacion, ['route' => ['marcaciones-conf-tipo.update', $tpMarcacion->id], 'method' => 'patch']) !!}

                        @include('tp_marcacions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
