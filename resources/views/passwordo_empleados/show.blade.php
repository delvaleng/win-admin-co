@extends('layouts.app')
@section('title', 'Contraseña Empleados')

@section('content')
    <section class="content-header">
        <h1>
            Contrase&ntilde;a Empleados
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('passwordo_empleados.show_fields')
                    <a href="{!! route('passwordoEmpleados.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
