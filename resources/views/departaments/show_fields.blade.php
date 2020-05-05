<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $departament->id !!}</p>
</div> -->

<!-- Departament Field -->
<div class="form-group col-sm-6">
    {!! Form::label('departament', 'Estado:') !!}
    <p>{!! $departament->departament !!}</p>
</div>

<!-- Id Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_country', 'Pais:') !!}
    <p>{!! $departament->getCountry->country !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($departament->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $departament->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $departament->updated_at !!}</p>
</div>
