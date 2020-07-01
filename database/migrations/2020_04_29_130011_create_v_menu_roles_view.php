<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVMenuRolesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE OR REPLACE VIEW v_menu_roles AS 
       SELECT DISTINCT mh.id,
          mh.seccion,
          mh.url,
          mh.ramaid,
          mh.ramanombre,
          rm.role_id,
          r.role_name,
          rm.id AS rol_main_id
         FROM winadmin.v_menu_hojas mh
           LEFT JOIN winadmin.rol_main rm ON mh.id = rm.main_id
           LEFT JOIN winadmin.roles r ON r.id = rm.role_id;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('v_menu_roles');
    }
}
