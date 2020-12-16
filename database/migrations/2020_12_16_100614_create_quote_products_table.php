<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->integer('quantity');
            $table->string('options');
            $table->integer('quote_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quote_id')->on('quotes')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_products');
    }
}
