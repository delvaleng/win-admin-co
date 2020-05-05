@extends('layouts.app')
@section('title', 'Pais')
@section('content')
    <section class="content-header">
        <h1>
          Pais
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($country, ['route' => ['pais.update', $country->id], 'method' => 'patch']) !!}

                        @include('countries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
