<!-- Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('state_name', 'Departamento:') !!}
  {!! Form::text('state_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country_id', 'Pais:') !!}
  {!! Form::select('country_id', $country, null,['id'=>'id_country', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
  <!-- {!! Form::text('id_country', null, ['class' => 'form-control']) !!} -->
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('departamentos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
