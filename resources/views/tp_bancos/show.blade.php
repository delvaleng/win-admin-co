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
                <div class="row" style="padding-left: 20px">
                    @include('tp_bancos.show_fields')
                    <a href="{!! route('tp-bancos.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
