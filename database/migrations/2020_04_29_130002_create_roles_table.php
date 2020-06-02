<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
          $table->increments('id');

          $table->text('role_name')->nullable();
          $table->text('note')->nullable();

          $table->boolean('status')->default(true);
          $table->integer('user_id')->nullable();

          $table->timestamps();
          $table->softDeletes();

          $table->foreign('user_id' )->references('id' )->on('users' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
