<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\RolMain;

class RolMainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $menu = 22;
      for ($i = 1; $i <= $menu; $i++) {
        RolMain::create([
          'role_id'  => '1',
          'main_id'  => $i,
        ]);
      }
      RolMain::create([
        'role_id'  => '2',
        'main_id'  => 23,
      ]);
      RolMain::create([
        'role_id'  => '2',
        'main_id'  => 24,
      ]);
    }
}
