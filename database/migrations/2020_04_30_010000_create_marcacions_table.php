<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarcacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_tp_marcacion')->default(null);
            $table->date('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin')->nullable();
            $table->double('total_min')->nullable();
            $table->text('latitud')->nullable();
            $table->text('longitud')->nullable();
            $table->text('observacion')->nullable();
            $table->text('ip_ubicacion')->nullable();
            $table->text('dispositivo')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tp_marcacion')->references('id')->on('tp_marcacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('marcacions');
    }
}
