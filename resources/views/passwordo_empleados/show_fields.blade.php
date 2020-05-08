<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $passwordoEmpleado->id !!}</p>
</div> -->

<!-- Id Empleado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_empleado', 'Empleado:') !!}
    <p>{!! $passwordoEmpleado->id_empleado !!}</p>
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Contrase&ntilde;a:') !!}
    <p>{!! $passwordoEmpleado->password !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($passwordoEmpleado->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $passwordoEmpleado->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $passwordoEmpleado->updated_at !!}</p>
</div>
