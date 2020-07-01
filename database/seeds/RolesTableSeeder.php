<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Roles::create([
        'role_name'  => 'SuperUsuario',
        'note'       => 'Este rol permitira toda acción en el sistema',
      ]);
      Roles::create([
        'role_name'  => 'Perfil',
        'note'       => 'Este rol permitira ver su perfiul y cambiar su contraseña',
      ]);

    }
}
