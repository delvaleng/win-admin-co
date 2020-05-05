<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tpPago->id !!}</p>
</div> -->

<!-- Descripci&oacute;n Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripci&oacute;n:') !!}
    <p>{!! $tpPago->description !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($tpPago->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $tpPago->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $tpPago->updated_at !!}</p>
</div>
