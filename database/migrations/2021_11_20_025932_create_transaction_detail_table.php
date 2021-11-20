<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("transactions_id");
            $table->bigInteger("product_id");
            $table->string("nama");
            $table->string("merek");
            $table->integer("harga");
            $table->integer("qty");
            $table->bigInteger("subtotal");
            $table->bigInteger("total");
            $table->bigInteger("bayar");
            $table->bigInteger("kembalian");
            $table->string("status");
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
        Schema::dropIfExists('transaction_detail');
    }
}
