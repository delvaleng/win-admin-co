<!-- Id Marcacion Field -->
<div class="form-group col-sm-12">
  {!! Form::label('id_marcacion', 'Empleado:') !!}
  <p>{!! ($autorizacionEmpleado->id_marcacion)? $autorizacionEmpleado->marcacion->empleado->first_name.' '.$autorizacionEmpleado->marcacion->empleado->last_name   : '-' !!}</p>
</div>

<!-- Id Marcacion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_marcacion', 'Tipo de Marcacion:') !!}
  <p>{!! ($autorizacionEmpleado->id_marcacion)? $autorizacionEmpleado->marcacion->tpMarcacion->descripcion  : '-' !!}</p>
</div>


<!-- Id Marcacion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_marcacion', 'Dia:') !!}
  <p>{!! ($autorizacionEmpleado->id_marcacion)?  date('d-m-Y', strtotime($autorizacionEmpleado->marcacion->dia)): '-' !!}</p>
</div>

<!-- Creado By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('creado_by', 'Creado:') !!}
  <p>{!! ($autorizacionEmpleado->creado_by)?  $autorizacionEmpleado->creadoBy->first_name.' '.$autorizacionEmpleado->creadoBy->last_name  : '-' !!}</p>
</div>

<!-- Aprobado By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('aprobado_by', 'Aprobado:') !!}
  <p>{!! ($autorizacionEmpleado->aprobado_by)?  $autorizacionEmpleado->aprobadoBy->first_name.' '.$autorizacionEmpleado->aprobadoBy->last_name  : '-' !!}</p>
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-12">
  {!! Form::label('observacion', 'Observacion:') !!}
  <p>{!! $autorizacionEmpleado->observacion !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'F/Creacion:') !!}
  <p>{!! $autorizacionEmpleado->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'F/Actualizado:') !!}
  <p>{!! $autorizacionEmpleado->updated_at !!}</p>
</div>
