<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $city->id !!}</p>
</div> -->

<!-- Id Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country_id', 'Pais:') !!}
  <p>{!! $city->getStateCountry[0]->country_name !!}</p>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('state_id', 'Departamento:') !!}
  <p>{!! $city->getState->state_name !!}</p>
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
  {!! Form::label('city_name', 'Ciudad:') !!}
  <p>{!! $city->city_name !!}</p>
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
