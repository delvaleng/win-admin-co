<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="tpMarcacions-table">
    <thead>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Descripci&oacute;n</th>
      </tr>
    </thead>

    <tbody>
      @foreach($tpMarcacions as $tpMarcacion)
      <tr>
        <td>
          {!! Form::open(['route' => ['tpMarcacions.destroy', $tpMarcacion->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('tpMarcacions.show', [$tpMarcacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('tpMarcacions.edit', [$tpMarcacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
        <td>{!! $tpMarcacion->descripcion !!}</td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Descripci&oacute;n</th>
      </tr>
    </tfoot>
  </table>
</div>
