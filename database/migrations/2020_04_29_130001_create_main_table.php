<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main', function (Blueprint $table) {
          $table->increments('id');

          $table->text('main_name')->nullable();
          $table->text('section')->nullable();
          $table->text('path')->nullable();
          $table->text('icon')->nullable();
          $table->integer('orden')->nullable();

          $table->boolean('status')->default(true);
          $table->integer('user_id')->nullable();

          $table->timestamps();
          $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main');
    }
}
