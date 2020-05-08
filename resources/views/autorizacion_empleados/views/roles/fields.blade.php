<!-- Descripcion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('description', 'Descripci&oacute;n:') !!}
  {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('roles.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div>
