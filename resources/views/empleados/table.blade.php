<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="empleados-table">
    <thead>
      <tr>
        <th>Acci&oacute;n</th>
        <th>C&oacute;digo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Pa&iacute;s</th>
        <th>Documento de Identidad</th>
        <th>Usuario</th>
      </tr>
    </thead>

    <tbody>
      @foreach($empleados as $empleado)
      <tr>
        <td>
          {!! Form::open(['route' => ['empleados.destroy', $empleado->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('empleados.show', [$empleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('empleados.edit', [$empleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
        <td>{!! $empleado->id !!}</td>
        <td>{!! $empleado->nombre !!}</td>
        <td>{!! $empleado->apellido !!}</td>
        <td>{!! $empleado->paisEmpleado->country !!}</td>
        <td>{!! $empleado->tpDocumentIdent->code !!} - {!! $empleado->num_documento !!}</td>
        <td>{!! $empleado->usuario !!}</td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <th>Acci&oacute;n</th>
        <th>C&oacute;digo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Pa&iacute;s</th>
        <th>Documento de Identidad</th>
        <th>Usuario</th>
      </tr>
    </tfoot>

  </table>
</div>
