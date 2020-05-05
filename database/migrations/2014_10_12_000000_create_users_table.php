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
            $table->integer('id_country')->unsigned()->default(null);
            $table->text('name');
            $table->text('lastname')->nullable();

            $table->text('dni')->unique()->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('gender')->nullable();

            $table->date('birthdate')->nullable();
            $table->string('username')->unique()->nullable();
            $table->text('password');
            $table->rememberToken();

            $table->text('note')->nullable();
            $table->integer('modified_by')->nullable()->default('1');
            $table->boolean('status_user'  )->nullable()->default(true);
            $table->boolean('status_system')->nullable()->default(true);

            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP(0)'));

            $table->foreign('id_country')->references('id')->on('countries');
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
