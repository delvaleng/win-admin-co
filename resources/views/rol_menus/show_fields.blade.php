<!-- Id Rol Field -->
<div class="form-group col-sm-6">
  {!! Form::label('role_id', 'Rol:') !!}
  <p>{!! ($rolMain->role_id)? $rolMain->getRol->role_name : '-' !!}</p>
</div>

<!-- Id Menu Field -->
<div class="form-group col-sm-6">
  {!! Form::label('main_id', 'Men&uacute;:') !!}
  <p>{!! ($rolMain->main_id)? $rolMain->getMenu->main_name : '-' !!}</p>
</div>

<!-- Note Field -->
<div class="form-group col-sm-12">
  {!! Form::label('note', 'Nota:') !!}
  <p>{!! $rolMain->note !!}</p>
</div>

<!-- Status System Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($rolMain->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Modified By Field -->
<div class="form-group col-sm-6">
  {!! Form::label('modified_by', 'Modificado por:') !!}
  <p>{!! $rolMain->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $rolMain->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $rolMain->updated_at !!}</p>
</div>
