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
                <div class="row">
                    {!! Form::open(['route' => 'passwordoEmpleados.store']) !!}

                        @include('passwordo_empleados.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
