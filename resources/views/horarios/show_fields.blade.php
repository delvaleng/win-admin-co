<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Empleado:') !!}
    <p>{!! $horario->horarioEmpleado[0]->nombre !!} {!! $horario->horarioEmpleado[0]->apellido  !!}</p>
</div>

<!-- Dia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dia', 'D&iacute;a:') !!}
    <p>{!! $horario->dia !!}</p>
</div>

<!-- Entrada Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entrada', 'Entrada:') !!}
    <p>{!! $horario->entrada !!}</p>
</div>

<!-- Salida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salida', 'Salida:') !!}
    <p>{!! $horario->salida !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $horario->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $horario->updated_at !!}</p>
</div>

<div class="form-group col-sm-6">
</div>
<div class="form-group col-sm-6">
</div>
