@extends('layouts.app')
@section('title', 'Tipo de Pago')
@section('content')
    <section class="content-header">
        <h1>
            Tipo de Pago
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('tp_pagos.show_fields')
                    <a href="{!! route('tp-pagos.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
