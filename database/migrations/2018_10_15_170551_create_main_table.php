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
          $table->text('description')->nullable();
          $table->text('section')->nullable();
          $table->text('path')->nullable();
          $table->text('icon')->nullable();
          $table->integer('orden')->nullable();
          $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
          $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
          $table->integer('modified_by')->nullable()->default('1');
          $table->boolean('status_system')->nullable()->default(true);
          $table->boolean('status_user'  )->nullable()->default(true);
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
