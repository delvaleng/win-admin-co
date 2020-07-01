<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\TpMarcacion;


class TpMarcacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TpMarcacion::create([
        'descripcion'  => 'INICIO',
      ]);

      TpMarcacion::create([
        'descripcion'  => 'ALMUERZO',
      ]);

      TpMarcacion::create([
        'descripcion'  => 'FIN ALMUERZO',
      ]);

      TpMarcacion::create([
        'descripcion'  => 'SALIDA',
      ]);

    }
}
