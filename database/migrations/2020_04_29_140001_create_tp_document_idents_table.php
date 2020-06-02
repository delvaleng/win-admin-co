<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTpDocumentIdentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_document_idents', function (Blueprint $table) {

            $table->increments('id');
            $table->integer   ('country_id')->unsigned();

            $table->text('tp_document_ident_name')->unique();
            $table->text('code')->unique();

            $table->boolean('status'  )->nullable()->default(true);
            $table->integer('user_id' )->nullable()->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id'   )->references('id' )->on('users' );
            $table->foreign('country_id')->references('id' )->on('countries' );

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tp_document_idents');
    }
}
