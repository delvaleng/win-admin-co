<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Main;

class MainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Main::create([
        'main_name'  => 'Ajustes',
        'section'    => '0',
        'path'       => null,
        'icon'       => 'fa-cogs',
        'orden'      => null,
        'user_id'    => 1,
      ]);

      Main::create([
       'main_name'  => 'Items',
       'section'    => '1',
       'path'       => null,
       'icon'       => 'fa-dot-circle-o',
       'orden'      => 1,
       'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Menú',
        'section'    => '2',
        'path'       => '/menus',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 1,
        'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Rol',
        'section'    => '2',
        'path'       => '/roles',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 2,
        'user_id'    => 1,
      ]);
      Main::create([
        'main_name'  => 'Rol/Menú',
        'section'    => '2',
        'path'       => '/rol-menus',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 3,
        'user_id'    => 1,
      ]);

    }
}
