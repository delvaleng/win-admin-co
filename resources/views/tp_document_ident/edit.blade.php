@extends('layouts.app')
@section('title', 'Documento Identidad')
@section('content')
    <section class="content-header">
        <h1>
            Documento Identidad
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tpDocumentoIdentidad, ['route' => ['tp-documentos-identidad.update', $tpDocumentoIdentidad->id], 'method' => 'patch']) !!}

                        @include('tp_document_ident.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
