<div class="table-responsive">
    <table class="stripe row-border order-column compact" id="statusRecargas-table">
        <thead>
            <tr>
              <th>Acci&oacute;n</th>
              <th>Descripci&oacute;n</th>
              <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
        @foreach($statusRecargas as $statusRecarga)
            <tr>
              <td>
                  <div class='btn-group'>
                      <a href="{!! route('estatus-recargas.show', [$statusRecarga->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                      <a href="{!! route('estatus-recargas.edit', [$statusRecarga->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  </div>
              </td>
              <td>{!! $statusRecarga->description !!}</td>
              <td>{!! ($statusRecarga->status  == 1)? 'ACTIVADO' : 'DESACTIVADO' !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
