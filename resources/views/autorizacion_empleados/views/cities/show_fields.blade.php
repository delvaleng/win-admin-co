<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $city->id !!}</p>
</div> -->

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'Ciudad:') !!}
    <p>{!! $city->city !!}</p>
</div>

<!-- Id Departament Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_departament', 'Departamento:') !!}
    <p>{!! $city->getDepartament->departament !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($city->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $city->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $city->updated_at !!}</p>
</div>
