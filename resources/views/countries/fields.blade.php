<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country_name', 'Pa&iacute;s:') !!}
  {!! Form::text('country_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('area_code', 'C&oacute;digo Pais:') !!}
  {!! Form::text('area_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('code', 'C&oacute;digo &Aacute;rea:') !!}
  {!! Form::text('code', null, ['class' => 'form-control', 'placeholder'=> '+51']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('national_currency', 'Moneda/Local:') !!}
  {!! Form::text('national_currency', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('foreign_currency', 'Moneda/Admitida:') !!}
  {!! Form::text('foreign_currency', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('national_symbol', 'S&iacute;mbolo/Local:') !!}
  {!! Form::text('national_symbol', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('foreign_symbol', 'S&iacute;mbolo/Admitida:') !!}
  {!! Form::text('foreign_symbol', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('convert_mount', 'Conversi&oacute;n/Monto:') !!}
  {!! Form::text('convert_mount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('pais.index') !!}" class="btn btn-default">Cancelar</a>
</div>
