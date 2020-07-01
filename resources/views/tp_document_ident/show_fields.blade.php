<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $tpDocumentoIdentidad->id !!}</p>
</div> -->

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
  <p>{!! $tpDocumentoIdentidad->descripcion !!}</p>
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
  {!! Form::label('code', 'C&oacute;digo:') !!}
  <p>{!! $tpDocumentoIdentidad->code !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($tpDocumentoIdentidad->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $tpDocumentoIdentidad->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $tpDocumentoIdentidad->updated_at !!}</p>
</div>
