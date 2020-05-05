<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetRamaNombreFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE FUNCTION getramanombre(p_idmenu integer)
        RETURNS character varying AS
        $BODY$
        DECLARE
          --Declaración de Variables
          p_ramanombre   VARCHAR; --Variable de retorno
          v_idseccion    INTEGER;
          v_ramanombre   VARCHAR;
        BEGIN
            /*Obtengo el idseccion del menu actual*/
            SELECT M.section, M.description
            INTO v_idseccion, v_ramanombre
            FROM WINSYSTEM.MAIN M
            WHERE M.id = p_idmenu;

             /* condición recursiva para obtener la rama de los id */
              if v_idseccion = 0 then
                  p_ramanombre := v_ramanombre;
                  return p_ramanombre;
              else
                  return WINSYSTEM.getRamaNombre(v_idseccion) || " > " || v_ramanombre;
              end if;

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
        DB::statement('getramanombre');
    }
}
