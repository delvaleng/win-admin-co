<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create([
        'role_name'  => 'SuperUsuario',
        'note'       => 'Este rol permitira toda acción en el sistema',
      ]);

    }
}
