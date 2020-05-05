<div class="table-responsive">
    <table class="stripe row-border order-column compact" id="tpCuentas-table">
        <thead>
            <tr>
              <th>Acci&oacute;n</th>
              <th>Descripci&oacute;n</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tpCuentas as $tpCuenta)
            <tr>
                <td>
                    <div class='btn-group'>
                        <a href="{!! route('tp-cuentas.show', [$tpCuenta->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tp-cuentas.edit', [$tpCuenta->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </td>
                <td>{!! $tpCuenta->description !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
