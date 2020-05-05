<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tpCuenta->id !!}</p>
</div> -->

<!-- Descripci&oacute;n Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripci&oacute;n:') !!}
    <p>{!! $tpCuenta->description !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($tpCuenta->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $tpCuenta->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $tpCuenta->updated_at !!}</p>
</div>
