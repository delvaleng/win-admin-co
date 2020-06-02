<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


      $this->truncateTables([
           'countries',
           'users',
           'main',
           'roles',
           'rol_users',
           'tp_marcacions',
           'tp_documento_identidads'
       ]);

        $this->call([
          CountryTableSeeder::class,
          UserTableSeeder::class,
          MainTableSeeder::class,
          RoleTableSeeder::class,
          RolMainTableSeeder::class,
          RolUserTableSeeder::class,
          TpMarcacionTableSeeder::class,
          TpDocumentoIdentidadTableSeeder::class,
        ]);


    }


    public function truncateTables(array $tables)
    {

      foreach ($tables as $table) {
        DB::table($table)->truncate();
      }

    }
}
