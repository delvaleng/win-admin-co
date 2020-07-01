<!-- Id Empleado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_user', 'Empleado:') !!}
  <p>{!! $horarioUser->empleado->first_name !!} {!! $horarioUser->empleado->last_name  !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($horarioUser->status== 1)? 'ACTIVO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $horarioUser->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $horarioUser->updated_at !!}</p>
</div>
