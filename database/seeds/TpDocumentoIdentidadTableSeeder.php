<?php

use Illuminate\Database\Seeder;
use App\Models\General\TpDocumentoIdentidad;

class TpDocumentoIdentidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TpDocumentoIdentidad::create([
        'descripcion'  => 'PASAPORTE',
        'code'         => 'P',

      ]);

      TpDocumentoIdentidad::create([
        'descripcion'  => 'CEDULA DE CIUDADANIA',
        'code'         => 'CC',
      ]);

      TpDocumentoIdentidad::create([
        'descripcion'  => 'CEDULA DE EXTRANJERIA',
        'code'         => 'CE',
      ]);

    }
}
