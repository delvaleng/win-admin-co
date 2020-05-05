<!-- Descripci&oacute;n Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripci&oacute;n:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>


<!-- Id Cuenta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_tp_cuenta', 'Tipo de Cuenta:') !!}
    {!! Form::select('id_tp_cuenta', $tpcuenta, null,['id'=>'id_tp_cuenta', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
    <!-- {!! Form::text('id_country', null, ['class' => 'form-control']) !!} -->
</div>

<!-- Id Cuenta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_country', 'Pais:') !!}
    {!! Form::select('id_country', $country, null,['id'=>'id_country', 'class'=>'form-control select2', 'style'=>'width: 100%'] ) !!}
    <!-- {!! Form::text('id_country', null, ['class' => 'form-control']) !!} -->
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tp-bancos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
