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
                <div class="row" style="padding-left: 20px">
                    @include('countries.show_fields')
                    <a href="{!! route('pais.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
