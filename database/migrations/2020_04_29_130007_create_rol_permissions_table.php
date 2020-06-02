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

            $table->integer('permission_id')->unsigned();
            $table->integer('rol_user_id'  )->unsigned();

            $table->boolean('status'  )->nullable()->default(true);
            $table->integer('user_id' )->nullable()->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('rol_user_id'  )->references('id'  )->on('rol_users');
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
