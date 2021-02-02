<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('request_id');
            $table->string('merchant_request_id');
            $table->string('phone_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->integer('amount')->nullable();
            $table->string('result_code')->nullable();
            $table->string('result_description')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('stk_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stk_responses');
    }
}
