<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_users', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('role_id')->unsigned();
          $table->integer('user_id')->unsigned();

          $table->boolean('status'  )->nullable()->default(true);

          $table->timestamps();
          $table->softDeletes();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_users');
    }
}
