<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name_suffix')->nullable();
            $table->string('street_one');
            $table->string('street_two')->nullable();
            $table->string('state')->nullable();
            $table->string('city');
            $table->string('county')->nullable();
            $table->string('country');
            $table->string('zip_code', 10);
            $table->string('phone', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
