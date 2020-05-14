<!-- Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('departament', 'Estado:') !!}
  {!! Form::text('departament', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_country', 'Pais:') !!}
  {!! Form::select('id_country', $country, null,['id'=>'id_country', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
  <!-- {!! Form::text('id_country', null, ['class' => 'form-control']) !!} -->
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('estados.index') !!}" class="btn btn-default">Cancelar</a>
</div>
