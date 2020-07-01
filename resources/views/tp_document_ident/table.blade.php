<div class="table-responsive">
    <table class="stripe row-border order-column compact" id="tpDocumentoIdentidads-table">
        <thead>
            <tr>
              <th width="30px">Acci&oacute;n</th>
              <th>P&aacute;is</th>
              <th>Descripci&oacute;n</th>
              <th>C&oacute;digo</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tpDocumentIdents as $tpDocumentIdent)
            <tr>
              <td>
                <div class='btn-group'>
                  <a href="{!! route('tp-documentos-identidad.show', [$tpDocumentIdent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                  <a href="{!! route('tp-documentos-identidad.edit', [$tpDocumentIdent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
              </td>
              <td>{!! $tpDocumentIdent->getCountry->country_name !!}</td>
              <td>{!! $tpDocumentIdent->tp_document_ident_name !!}</td>
              <td>{!! $tpDocumentIdent->code !!}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
          <tr>
            <th>Acci&oacute;n</th>
            <th>P&aacute;is</th>
            <th>Descripci&oacute;n</th>
            <th>C&oacute;digo</th>
          </tr>
        </tfoot>
    </table>
</div>
