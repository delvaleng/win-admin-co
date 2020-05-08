@extends('layouts.app')
@section('title', 'Estado')
@section('content')
    <section class="content-header">
        <h1>
            Estado
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('departaments.show_fields')
                    <a href="{!! route('estados.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
