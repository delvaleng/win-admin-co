<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\TpDocumentIdent ;

class TpDocumentIdentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TpDocumentIdent::create([
        'tp_document_ident_name'  => 'PASAPORTE',
        'code'                    => 'P',
        'country_id'              => '1',

      ]);

      TpDocumentIdent::create([
        'tp_document_ident_name'  => 'CEDULA DE CIUDADANIA',
        'code'                    => 'CC',
        'country_id'              => '1',
      ]);

      TpDocumentIdent::create([
        'tp_document_ident_name'  => 'CEDULA DE EXTRANJERIA',
        'code'                    => 'CE',
        'country_id'              => '1',
      ]);

    }
}
