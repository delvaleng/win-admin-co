<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="horarios-table">
    <thead>
      <tr>
        <th width="60px">Acci&oacute;n</th>
        <th>D&iacute;a</th>
        <th>Entrada</th>
        <th>Salida</th>
      </tr>
    </thead>
    <tbody>
      @foreach($horarios as $horario)
      <tr>
        <td>
          {!! Form::open(['route' => ['horarios.destroy', $horario->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('horarios.show', [$horario->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('horarios.edit', [$horario->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('
            Estas seguro?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
        <td>{!! $horario->dia !!}</td>
        <td>{!! $horario->entrada !!}</td>
        <td>{!! $horario->salida !!}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>Acci&oacute;n</th>
        <th>D&iacute;a</th>
        <th>Entrada</th>
        <th>Salida</th>
      </tr>
    </tfoot>
  </table>
</div>
