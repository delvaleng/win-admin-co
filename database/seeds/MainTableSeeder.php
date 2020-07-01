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
        'orden'      => 20,
        'user_id'    => 1,
      ]);

      Main::create([
       'main_name'  => 'Items',
       'section'    => '1',
       'path'       => null,
       'icon'       => 'fa-list',
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
      Main::create([
        'main_name'  => 'Rol/Usuarios',
        'section'    => '2',
        'path'       => '/rol-usuarios',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 3,
        'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Usuarios',
        'section'    => '0',
        'path'       => null,
        'icon'       => 'fa-users',
        'orden'      => 19,
        'user_id'    => 1,
      ]);
      Main::create([
        'main_name'  => 'Listado',
        'section'    => '7',
        'path'       => '/usuarios',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 2,
        'user_id'    => 1,
      ]);

      //////////////////
      Main::create([
        'main_name'  => 'Marcaciones',
        'section'    => '0',
        'path'       => null,
        'icon'       => 'fa-hand-pointer-o',
        'orden'      => 18,
        'user_id'    => 1,
      ]);
      Main::create([
        'main_name'  => 'Listado',
        'section'    => '9',
        'path'       => '/marcaciones',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 1,
        'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Autorizaciones',
        'section'    => '9',
        'path'       => '/marcaciones-autorizaciones',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 2,
        'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Reporte General',
        'section'    => '9',
        'path'       => '/marcaciones-reporte-general',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 3,
        'user_id'    => 1,
      ]);


      Main::create([
        'main_name'  => 'Configuraciones',
        'section'    => '9',
        'path'       => null,
        'icon'       => 'fa-cogs',
        'orden'      => 6,
        'user_id'    => 1,
      ]);

      Main::create([
        'main_name'  => 'Tipo de Marcacion',
        'section'    => '13',
        'path'       => '/marcaciones-conf-tipo',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 1,
        'user_id'    => 1,
      ]);
      Main::create([
        'main_name'  => 'Horarios',
        'section'    => '13',
        'path'       => '/marcaciones-conf-horarios',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 2,
        'user_id'    => 1,
      ]);//15
      //DIRECCIONES
      Main::create([
        'main_name'  => 'Direcciones',
        'section'    => '1',
        'path'       => null,
        'icon'       => 'fa-map-pin',
        'orden'      => 1,
        'user_id'    => 1,
      ]);//16

      Main::create([
        'main_name'  => 'Pais',
        'section'    => '16',
        'path'       => '/pais',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 1,
        'user_id'    => 1,
      ]);//17
      Main::create([
        'main_name'  => 'Departamentos',
        'section'    => '16',
        'path'       => '/departamentos',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 2,
        'user_id'    => 1,
      ]);//18
      Main::create([
        'main_name'  => 'Ciudades',
        'section'    => '16',
        'path'       => '/ciudades',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 3,
        'user_id'    => 1,
      ]);//19

      Main::create([
        'main_name'  => 'Tipos',
        'section'    => '1',
        'path'       => null,
        'icon'       => 'fa-th-large',
        'orden'      => 1,
        'user_id'    => 1,
      ]);//20
      Main::create([
        'main_name'  => 'Documentos de Identidad',
        'section'    => '20',
        'path'       => '/tp-documentos-identidad',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 3,
        'user_id'    => 1,
      ]);//21

      Main::create([
        'main_name'  => 'Auditoria',
        'section'    => '0',
        'path'       => '/auditoria',
        'icon'       => 'fa-user-secret',
        'orden'      => 17,
        'user_id'    => 1,
      ]);//22

      Main::create([
        'main_name'  => 'Mi Perfil',
        'section'    => '0',
        'path'       => '/mi-perfil',
        'icon'       => 'fa-dot-circle-o',
        'orden'      => 1,
        'user_id'    => 1,
      ]);//23
      Main::create([
        'main_name'  => 'Cambiar Contraseña',
        'section'    => '0',
        'path'       => '/cambiar-contrasena',
        'icon'       => 'fa-key',
        'orden'      => 2,
        'user_id'    => 1,
      ]);//24



    }
}
