<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            //Datos basicos:
            $table->string('username')->unique();
            $table->text('first_name')->nullable();
            $table->text('last_name' )->nullable();
            //Datos de contacto:
            $table->text('phone'     )->nullable();
            $table->text('email'     )->nullable();
            //Datos de session:
            $table->text  ('password');
            $table->rememberToken();

            $table->boolean('employee')->nullable()->default(true);
            $table->boolean('status'  )->nullable()->default(true);
            $table->integer('created_by_id' )->nullable()->unsigned();
            $table->integer('country_id')->default(null)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id' )->references('id' )->on('users' );
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
