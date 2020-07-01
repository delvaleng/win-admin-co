<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $state->id !!}</p>
</div> -->

<!-- Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('state_name', 'Estado:') !!}
  <p>{!! $state->state_name !!}</p>
</div>

<!-- Id Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country_id', 'Pais:') !!}
  <p>{!! $state->getCountry->country_name !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($state->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Creado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado:') !!}
  <p>{!! $state->created_at !!}</p>
</div>

<!-- Actualizado Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado:') !!}
  <p>{!! $state->updated_at !!}</p>
</div>
