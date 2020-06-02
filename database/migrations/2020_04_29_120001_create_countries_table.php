<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {

            $table->increments('id');
            //Datos Basicos:
            $table->text('country_name')->unique();
            $table->text('area_code')->unique();
            $table->text('code')->unique();
            //Datos Moneda:
            $table->text('national_currency');
            $table->text('national_symbol'  );
            $table->text('foreign_currency' );
            $table->text('foreign_symbol'   );
            $table->double('convert_mount', 10,2);

            $table->boolean('status')->default(true);

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
        Schema::drop('countries');
    }
}
