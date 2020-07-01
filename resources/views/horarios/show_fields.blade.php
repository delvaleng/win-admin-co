<!-- Id Field -->
<div class="form-group col-sm-12">
  {!! Form::label('id', 'Empleado:') !!}
  <p>{!! $horario->horarioEmpleado[0]->first_name !!} {!! $horario->horarioEmpleado[0]->last_name  !!}</p>
</div>

<!-- Dia Field -->
<div class="form-group col-sm-4">
  {!! Form::label('dia', 'D&iacute;a:') !!}
  <p>{!! $horario->dia !!}</p>
</div>

<!-- Entrada Field -->
<div class="form-group col-sm-4">
  {!! Form::label('entrada', 'Entrada:') !!}
  <p>{!! $horario->entrada !!}</p>
</div>

<!-- Salida Field -->
<div class="form-group col-sm-4">
  {!! Form::label('salida', 'Salida:') !!}
  <p>{!! $horario->salida !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-4">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $horario->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-8">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $horario->updated_at !!}</p>
</div>
