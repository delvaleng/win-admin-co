<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriverSaldoTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_saldo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country')->unsigned();
            $table->integer('id_enlace_conductor')->unsigned();
            $table->text('id_enlace_app')->unsigned();
            $table->text('codigo_oficina')->unsigned();
            $table->text('usuario_oficina')->unsigned();
            $table->double('saldo_actual',10,2)->unsigned();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_saldo');
    }
}
