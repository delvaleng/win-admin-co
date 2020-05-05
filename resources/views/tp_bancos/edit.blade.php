@extends('layouts.app')
@section('title', 'Tipo de Banco')
@section('content')
    <section class="content-header">
        <h1>
            Tipo de Banco
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tpBanco, ['route' => ['tp-bancos.update', $tpBanco->id], 'method' => 'patch']) !!}

                        @include('tp_bancos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
