<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $country->id !!}</p>
</div> -->

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Pais:') !!}
    <p>{!! $country->country !!}</p>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('code', 'Codigo:') !!}
    <p>{!! $country->code !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('moneda_local', 'Moneda/Local:') !!}
    <p>{!! $country->moneda_local !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('moneda_admitida', 'Moneda/Admitida:') !!}
    <p>{!! $country->moneda_admitida !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('simbolo_local', 'Simbolo/Local:') !!}
    <p>{!! $country->simbolo_local !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('simbolo_admitida', 'Simbolo/Admitida:') !!}
    <p>{!! $country->simbolo_admitida !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('conversion_monto', 'Conversion/Monto:') !!}
    <p>{!! $country->conversion_monto !!}</p>
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
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
