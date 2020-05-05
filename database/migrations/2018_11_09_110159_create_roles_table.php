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
          $table->text('description')->nullable();
          $table->text('note')->nullable();
          $table->integer('modified_by')->nullable()->default('1');
          $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
          $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
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
        Schema::dropIfExists('roles');
    }
}
