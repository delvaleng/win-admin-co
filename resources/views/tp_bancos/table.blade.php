<div class="table-responsive">
    <table class="stripe row-border order-column compact" id="tpBancos-table">
        <thead>
            <tr>
              <th>Acci&oacute;n</th>
              <th>Banco</th>
              <th>Tipo de Cuenta</th>
              <th>Pais</th>

            </tr>
        </thead>
        <tbody>
        @foreach($tpBancos as $tpBanco)
            <tr>
                <td>
                    <div class='btn-group'>
                        <a href="{!! route('tp-bancos.show', [$tpBanco->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tp-bancos.edit', [$tpBanco->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </td>
                <td>{!! $tpBanco->description !!}</td>
                <td>{!! ($tpBanco->id_tp_cuenta)? $tpBanco->getTpCuenta->description : '-' !!}</td>
                <td>{!! ($tpBanco->id_country  )? $tpBanco->getCountry->country      : '-' !!}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
