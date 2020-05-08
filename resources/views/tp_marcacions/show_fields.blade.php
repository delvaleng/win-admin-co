<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $tpMarcacion->id !!}</p>
</div> -->

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
    <p>{!! $tpMarcacion->descripcion !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($tpMarcacion->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $tpMarcacion->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $tpMarcacion->updated_at !!}</p>
</div>
