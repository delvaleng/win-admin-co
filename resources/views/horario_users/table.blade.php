<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="horarioUsers-table">
    <thead>
      <tr>
        <th width="25px">Acci&oacute;n</th>
        <th>Empleado</th>
      </tr>
    </thead>
    <tbody>
      @foreach($horarioUsers as $horarioUser)
      <tr>
        <td>
          <div class='btn-group'>
            <a href="{!! route('marcaciones-conf-horarios.show', [$horarioUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('marcaciones-conf-horarios.edit', [$horarioUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
          </div>
        </td>
        <td>{!! $horarioUser->empleado->first_name !!} {!! $horarioUser->empleado->last_name  !!}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>Acci&oacute;n</th>
        <th>Empleado</th>
      </tr>
    </tfoot>
  </table>
</div>
