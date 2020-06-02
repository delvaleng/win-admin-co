<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_main', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('role_id')->unsigned();
          $table->integer('main_id')->unsigned();
          $table->text('note')->nullable();

          $table->boolean('status')->default(true);
          $table->integer('user_id')->nullable();

          $table->timestamps();
          $table->softDeletes();

          $table->foreign('user_id' )->references('id' )->on('users' );
          $table->foreign('role_id' )->references('id' )->on('roles');
          $table->foreign('main_id' )->references('id' )->on('main');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_main');
    }
}
