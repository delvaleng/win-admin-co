<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="passwordoEmpleados-table">
    <thead>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Empleado</th>
        <th>Contrase&ntilde;a</th>
        <th>Estatus</th>
      </tr>
    </thead>
    <tbody>
      @foreach($passwordoEmpleados as $passwordoEmpleado)
      <tr>
        <td>
          {!! Form::open(['route' => ['passwordoEmpleados.destroy', $passwordoEmpleado->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('passwordoEmpleados.show', [$passwordoEmpleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('passwordoEmpleados.edit', [$passwordoEmpleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
        <td>{!! $passwordoEmpleado->empleado->nombre !!} {!! $passwordoEmpleado->empleado->apellido  !!}</td>
        <td>{!! $passwordoEmpleado->password !!}</td>
        <td>{!! ($passwordoEmpleado->status == 1)? 'Activa' : 'Inactiva' !!}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Empleado</th>
        <th>Contrase&ntilde;a</th>
        <th>Estatus</th>
      </tr>
    </tfoot>
  </table>
</div>
