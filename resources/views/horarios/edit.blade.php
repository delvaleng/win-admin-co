@extends('layouts.app')
@section('title', 'Horario')

@section('content')
    <section class="content-header">
        <h1>
            Horario
        </h1>
   </section>
   <div class="content">
       
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($horario, ['route' => ['horarios.update', $horario->id], 'method' => 'patch']) !!}

                        @include('horarios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
