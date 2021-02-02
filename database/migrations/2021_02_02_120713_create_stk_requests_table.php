<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_id')->unique('CheckoutRequestID');
            $table->string('msisdn');
            $table->string('bill_ref_number');
            $table->integer('amount')->nullable();
            $table->integer('paid')->default(0);
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
        Schema::dropIfExists('stk_requests');
    }
}
