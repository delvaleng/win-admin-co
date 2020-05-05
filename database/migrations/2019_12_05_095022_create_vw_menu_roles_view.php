<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwMenuRolesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement(" CREATE OR REPLACE VIEW vw_menu_roles AS
          SELECT DISTINCT
            mh.id,
            mh.idseccion,
            mh.url,
            mh.ramaid,
            mh.ramanombre,
            rm.id_role AS id_rol,
            r.description AS descripcion,
            rm.id AS id_rol_main
          FROM winsystem.vw_menu_hojas mh
          LEFT JOIN winsystem.rol_main rm ON mh.id = rm.id_main
          LEFT JOIN winsystem.roles r ON r.id = rm.id_role;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('vw_menu_roles');
    }
}
