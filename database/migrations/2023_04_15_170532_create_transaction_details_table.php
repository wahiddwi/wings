<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_code');
            $table->unsignedBigInteger('document_code');
            $table->integer('quantity');
            $table->integer('sub_total');

            $table->foreign('product_code')->references('id')->on('product');
            $table->foreign('document_code')->references('id')->on('transaction_header');
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
        Schema::dropIfExists('transaction_details');
    }
};
