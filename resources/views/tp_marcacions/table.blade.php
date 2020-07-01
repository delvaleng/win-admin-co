<div class="table-responsive">
  <table class="stripe row-border order-column compact" id="tpMarcacions-table">
    <thead>
      <tr>
        <th width="10px">Acci&oacute;n</th>
        <th>Descripci&oacute;n</th>
      </tr>
    </thead>

    <tbody>
      @foreach($tpMarcacions as $tpMarcacion)
      <tr>
        <td>
          <div class='btn-group'>
            <a href="{!! route('marcaciones-conf-tipo.show', [$tpMarcacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          </div>
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
