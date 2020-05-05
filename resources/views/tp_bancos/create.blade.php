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
                    {!! Form::open(['route' => 'tp-bancos.store']) !!}

                        @include('tp_bancos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
