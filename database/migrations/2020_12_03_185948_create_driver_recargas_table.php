<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriverRecargasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_recargas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_driver_saldo'  )->unsigned();
            $table->integer('id_tp_pago'       )->unsigned();
            $table->integer('id_status_recarga')->unsigned();
            $table->text('num_operacion'          )->unsigned();

            $table->date('fecha_pago'          )->unsigned();
            $table->time('hora_pago'           )->unsigned();

            $table->double('saldo_previo', 10,2)->unsigned();
            $table->double('saldo_recarga',10,2)->unsigned();
            $table->double('saldo_final',  10,2)->nullable()->unsigned();

            $table->text('observacion'   )->nullable()->unsigned();
            $table->integer('responsable')->nullable()->unsigned();
            $table->boolean('status'     )->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_driver_saldo'  )->references('id')->on('driver_saldo');
            $table->foreign('id_tp_pago'       )->references('id')->on('tp_pagos');
            $table->foreign('id_status_recarga')->references('id')->on('status_recargas');
            $table->foreign('responsable'      )->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_recargas');
    }
}
