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
        'country_name'         => 'PERU',
        'area_code'            => 'PE',
        'code'                 => '+51',
        'national_currency'    => 'SOLES',
        'national_symbol'      => 'S/.',
        'foreign_currency'     => 'DOLAR',
        'foreign_symbol'       => '$',
        'convert_mount'        => 3.4,
        'status'               => TRUE,
     ]);
    }
}
