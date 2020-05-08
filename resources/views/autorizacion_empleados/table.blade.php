<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="autorizacionEmpleados-table">
    <thead>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Empleado</th>
        <th>Dia</th>
        <th>Tipo de Marcacion</th>
        <th>Creado</th>
        <th>Aprobado</th>
        <th>Observacion</th>
      </tr>
    </thead>
    <tbody>
      @foreach($autorizacionEmpleados as $autorizacionEmpleado)
      <tr>
        <td>
          {!! Form::open(['route' => ['autorizacionEmpleados.destroy', $autorizacionEmpleados->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('autorizacionEmpleados.show', [$autorizacionEmpleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('autorizacionEmpleados.edit', [$autorizacionEmpleado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
        <td>{!! ($autorizacionEmpleado->id_marcacion)? $autorizacionEmpleado->marcacion->empleado->nombre.' '.$autorizacionEmpleado->marcacion->empleado->apellido   : '-' !!}</td>
        <td>{!! ($autorizacionEmpleado->id_marcacion)?  date('d-m-Y', strtotime($autorizacionEmpleado->marcacion->dia)): '-' !!}</td>
        <td>{!! ($autorizacionEmpleado->id_marcacion)? $autorizacionEmpleado->marcacion->tpMarcacion->descripcion  : '-' !!}</td>

        <td>{!! ($autorizacionEmpleado->creado_by)?  $autorizacionEmpleado->creadoBy->nombre.' '.$autorizacionEmpleado->creadoBy->apellido  : '-' !!}</td>
        <td>{!! ($autorizacionEmpleado->aprobado_by)?  $autorizacionEmpleado->aprobadoBy->nombre.' '.$autorizacionEmpleado->aprobadoBy->apellido  : '-' !!}</td>
        <td>{!! $autorizacionEmpleado->observacion !!}</td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
        <tr>
          <th>Acci&oacute;n</th>
          <th>Empleado</th>
          <th>Dia</th>
          <th>Tipo de Marcacion</th>
          <th>Creado</th>
          <th>Aprobado</th>
          <th>Observacion</th>
        </tr>
    </tfoot>
  </table>
</div>
