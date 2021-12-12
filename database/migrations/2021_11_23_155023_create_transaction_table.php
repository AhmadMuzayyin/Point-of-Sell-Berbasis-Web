<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('no');
            $table->string('status');
            $table->string('total')->nullable();
            $table->string('bayar')->nullable();
            $table->string('kembalian')->nullable();
            $table->integer("diskon_persentase")->nullable();
            $table->integer("diskon")->nullable();
            $table->integer("id_member")->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
