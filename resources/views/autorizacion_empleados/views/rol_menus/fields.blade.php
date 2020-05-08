<!-- Id Rol Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_role', 'Rol:') !!}
  {!! Form::select('id_role', $rols, null, ['id'=>'id_role', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
    <!-- {!! Form::text('id_tp_rol', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Menu Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_main', 'Men&uacute;:') !!}
  {!! Form::select('id_main', $menu, null, ['id'=>'id_main', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  <!-- {!! Form::text('id_menu', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Note Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('note', 'Nota:') !!}
  {!! Form::text('note', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Modified By Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('modified_by', 'Modificado por:') !!}
  {!! Form::text('modified_by', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('rol-menus.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
