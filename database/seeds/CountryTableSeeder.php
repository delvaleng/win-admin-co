<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Country::create([
        'country_name'         => 'COLOMBIA',
        'area_code'            => 'CO',
        'code'                 => '+57',
        'national_currency'    => 'PESOS',
        'national_symbol'      => '$.',
        'foreign_currency'     => 'DOLAR',
        'foreign_symbol'       => '$',
        'convert_mount'        => 3.500,
        'status'               => TRUE,
     ]);
    }
}
