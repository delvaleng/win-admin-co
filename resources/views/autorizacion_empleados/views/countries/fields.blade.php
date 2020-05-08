<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Pais:') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('code', 'Codigo:') !!}
  {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('moneda_local', 'Moneda/Local:') !!}
  {!! Form::text('moneda_local', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('moneda_admitida', 'Moneda/Admitida:') !!}
  {!! Form::text('moneda_admitida', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('simbolo_local', 'Simbolo/Local:') !!}
  {!! Form::text('simbolo_local', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('simbolo_admitida', 'Simbolo/Admitida:') !!}
  {!! Form::text('simbolo_admitida', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('conversion_monto', 'Conversion/Monto:') !!}
  {!! Form::text('conversion_monto', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pais.index') !!}" class="btn btn-default">Cancelar</a>
</div>
