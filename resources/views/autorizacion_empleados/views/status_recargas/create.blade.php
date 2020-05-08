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
                <div class="row">
                    {!! Form::open(['route' => 'estatus-recargas.store']) !!}

                        @include('status_recargas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
