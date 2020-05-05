<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_permissions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_permission')->unsigned();
            $table->integer('id_roluser')->unsigned();

            $table->text('note')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));

            $table->integer('modified_by')->nullable()->default('1');
            $table->integer('create_by')->nullable()->default('1');
            $table->boolean('status_system')->nullable()->default(true);
            $table->boolean('status_user'  )->nullable()->default(true);

            $table->foreign('id_roluser')->references('id')->on('rol_user');
            $table->foreign('id_permission')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_permissions');
    }
}
