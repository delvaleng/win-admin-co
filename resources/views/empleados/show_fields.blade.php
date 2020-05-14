<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $empleado->id !!}</p>
</div> -->

<!-- Nombres Field -->
<div class="form-group col-sm-6">
  {!! Form::label('nombre', 'Nombres:') !!}
  <p>{!! $empleado->nombre !!}</p>
</div>

<!-- Apellidos Field -->
<div class="form-group col-sm-6">
  {!! Form::label('apellido', 'Apellidos:') !!}
  <p>{!! $empleado->apellido !!}</p>
</div>

<!-- Documento de Identidad Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_tp_documento_identidad', 'Documento de Identidad:') !!}
  <p>{!! $empleado->tpDocumentIdent->code !!} - {!! $empleado->num_documento !!}</p>
</div>

<!-- Usuario Field -->
<div class="form-group col-sm-6">
  {!! Form::label('usuario', 'Usuario:') !!}
  <p>{!! $empleado->usuario !!}</p>
</div>

<!-- Estatus Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($empleado->status == 1)? 'ACTIVO' : 'INACTIVO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $empleado->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $empleado->updated_at !!}</p>
</div>

<div class="form-group col-sm-6">
</div>

<div class="form-group col-sm-6">
</div>
