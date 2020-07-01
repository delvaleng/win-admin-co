<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVMenuHojasView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE OR REPLACE VIEW v_menu_hojas AS
       SELECT m.id,
          m.section AS seccion,
          m.path AS url,
          winadmin.getramaid(m.id) AS ramaid,
          winadmin.getramanombre(m.id) AS ramanombre
         FROM winadmin.main m
        WHERE m.status = true AND m.path IS NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('v_menu_hojas');
    }
}
