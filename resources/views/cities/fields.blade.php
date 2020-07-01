<!-- City Field -->

<div class="form-group col-sm-6">
  {!! Form::label('city_name', 'Ciudad:') !!}
  {!! Form::text('city_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('state_id', 'Departamento:') !!}
  {!! Form::select('state_id', $state, null,['id'=>'state_id', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('ciudades.index') !!}" class="btn btn-default">Cancelar</a>
</div>
