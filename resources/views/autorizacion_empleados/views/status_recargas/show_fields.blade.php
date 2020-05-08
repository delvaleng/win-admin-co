

<!-- Descripci&oacute;n Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripci&oacute;n:') !!}
    <p>{!! $statusRecarga->description !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($statusRecarga->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $statusRecarga->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $statusRecarga->updated_at !!}</p>
</div>
