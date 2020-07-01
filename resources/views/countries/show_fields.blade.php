<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $country->id !!}</p>
</div> -->

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country', 'Pa&iacute;s:') !!}
  <p>{!! $country->country_name !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('area_code', 'C&oacute;digo Pais:') !!}
  <p>{!! $country->area_code !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('code', 'C&oacute;digo &Aacute;rea:') !!}
  <p>{!! $country->code !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('national_currency', 'Moneda/Local:') !!}
  <p>{!! $country->national_currency !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('foreign_currency', 'Moneda/Admitida:') !!}
  <p>{!! $country->foreign_currency !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('national_symbol', 'S&iacute;mbolo/Local:') !!}
  <p>{!! $country->national_symbol !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('foreign_symbol', 'S&iacute;mbolo/Admitida:') !!}
  <p>{!! $country->foreign_symbol !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('convert_mount', 'Conversi&oacute;n/Monto:') !!}
  <p>{!! $country->convert_mount !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($country->status == 1)? 'ACTIVO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $country->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $country->updated_at !!}</p>
</div>
