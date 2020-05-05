<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTpBancosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tp_cuenta')->unsigned();
            $table->integer('id_country')->unsigned();

            $table->text('description')->unique();
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tp_cuenta')->references('id')->on('tp_cuentas');
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
        Schema::drop('tp_bancos');
    }
}
