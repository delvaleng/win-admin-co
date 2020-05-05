<div class="table-responsive">
    <table class="stripe row-border order-column compact" id="tpPagos-table">
        <thead>
            <tr>
              <th>Acci&oacute;n</th>
              <th>Descripci&oacute;n</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tpPagos as $tpPago)
            <tr>
                <td>
                    <div class='btn-group'>
                        <a href="{!! route('tp-pagos.show', [$tpPago->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tp-pagos.edit', [$tpPago->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </td>
                <td>{!! $tpPago->description !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
