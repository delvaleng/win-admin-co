@if($horario != null)
<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Empleado:') !!}
    <p>{!! $horario->horarioEmpleado[0]->first_name !!} {!! $horario->horarioEmpleado[0]->last_name  !!}</p>
</div>
@endif

<!-- Dia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dia', 'D&iacute;a:') !!}
    {!! Form::text('dia', null, ['class' => 'form-control', 'readonly']) !!}
</div>
<!-- Dia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entrada', 'Entrada:') !!}
    {!! Form::time('entrada', null, ['class' => 'form-control']) !!}
</div>
<!-- Dia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salida', 'Salida:') !!}
    {!! Form::time('salida', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if($horario != null)
      <a href="{!! route('marcaciones-conf-horarios.show', [$horario->id_horario_user]) !!}" class="btn btn-default">Cancelar</a>
    @else
      <a href="{!! route('marcaciones-conf-horarios.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>
