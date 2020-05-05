<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwMenuHojasView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement(" CREATE OR REPLACE VIEW vw_menu_hojas AS
       SELECT m.id,
              m.section AS idseccion,
              m.path AS url,
              winsystem.getramaid(m.id) AS ramaid,
              winsystem.getramanombre(m.id) AS ramanombre
         FROM winsystem.main m
        WHERE m.status_user = true AND m.status_system AND m.path IS NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('vw_menu_hojas');
    }
}
