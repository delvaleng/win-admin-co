<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriverRecargaDetallesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_recarga_detalles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_driver_recarga')->unique()->unsigned();
            $table->integer('id_tp_banco'      )->nullable()->unsigned();

            $table->text('num_comprobante'     )->nullable()->unsigned();
            $table->text('imagen'              )->nullable()->unsigned();
            $table->text('observacion'         )->nullable()->unsigned();
            $table->boolean('status'           )->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_tp_banco'      )->references('id')->on('tp_bancos');
            $table->foreign('id_driver_recarga')->references('id')->on('driver_recargas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_recarga_detalles');
    }
}
