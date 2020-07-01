<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetRamaIdFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE OR REPLACE FUNCTION winadmin.getramaid(p_idmenu integer)
        RETURNS character varying AS
      $BODY$
      DECLARE
        --Declaración de Variables
        p_ramaid       VARCHAR;
        v_idseccion    INTEGER;
      BEGIN
      /*Obtengo el idseccion del menu actual*/
      SELECT M.section
      INTO v_idseccion
      FROM winadmin.main m
      WHERE m.id = p_idmenu;

       /* condición recursiva para obtener la rama de los id */
        IF v_idseccion = 0 THEN
            p_ramaid := p_idmenu::text;
            RETURN p_ramaid;
        ELSE
            RETURN winadmin.getramaid(v_idseccion) || \',\' || p_idmenu::text;
        END IF;

      END;
      $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('getramaid');
    }
}
