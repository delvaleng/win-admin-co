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
      $menu = 5;
      for ($i = 1; $i <= $menu; $i++) {
        RolMain::create([
          'role_id'  => '1',
          'main_id'  => $i,
        ]);
      }
    }
}
