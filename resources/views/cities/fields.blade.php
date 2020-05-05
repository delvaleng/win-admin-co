<!-- City Field -->

<div class="form-group col-sm-6">
    {!! Form::label('city', 'Ciudad:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_departament', 'Departamento:') !!}
  {!! Form::select('id_departament', $departament, null,['id'=>'id_departament', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ciudad.index') !!}" class="btn btn-default">Cancelar</a>
</div>
