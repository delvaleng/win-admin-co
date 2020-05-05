<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tpBanco->id !!}</p>
</div> -->

<!-- Descripci&oacute;n Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripci&oacute;n:') !!}
    <p>{!! $tpBanco->description !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_tp_cuenta', 'Tipo de Cuenta:') !!}
    <p>{!! ($tpBanco->id_tp_cuenta)? $tpBanco->getTpCuenta->description : '-' !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_country', 'Pais:') !!}
    <p>{!! ($tpBanco->id_country)? $tpBanco->getCountry->country   : '-' !!}</p>
</div>
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($tpBanco->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $tpBanco->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $tpBanco->updated_at !!}</p>
</div>
