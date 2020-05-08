@extends('layouts.app')
@section('title', 'Ciudad')
@section('content')
    <section class="content-header">
        <h1>
            Ciudad
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'ciudad.store']) !!}

                        @include('cities.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
