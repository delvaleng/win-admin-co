@extends('layouts.app')
@section('title', 'Estatus Recargas')
@section('content')
    <section class="content-header">
        <h1>
            Estatus Recargas
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('status_recargas.show_fields')
                    <a href="{!! route('estatus-recargas.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
