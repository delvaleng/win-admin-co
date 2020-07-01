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
                <div class="row" style="padding-left: 20px">
                    @include('tp_marcacions.show_fields')
                    <a href="{!! route('marcaciones-conf-tipo.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
