<!-- Id Users App Field -->
<div class="form-group col-sm-6">
  {!! Form::label('user_id', 'Usuario:') !!}
  <p>{!! ($rolUsers->user_id)? $rolUsers->getUsers->username : '-' !!} - {!! ($rolUsers->user_id)? $rolUsers->getUsers->email : '-' !!} </p>
</div>

<!-- Id Tp Rol Field -->
<div class="form-group col-sm-6">
  {!! Form::label('role_id', 'Rol:') !!}
  <p>{!! $rolUsers->getTpRol->role_name !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($rolUsers->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $rolUsers->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $rolUsers->updated_at !!}</p>
</div>
