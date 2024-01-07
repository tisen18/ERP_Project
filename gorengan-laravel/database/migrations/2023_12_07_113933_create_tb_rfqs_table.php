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
        Schema::create('tb_rfq', function (Blueprint $table) {
            $table->id('kode_rfq');
            $table->integer('kode_vendor');
            $table->string('tanggal_order', 255);
            $table->integer('status');
            $table->double('total_harga');
            $table->integer('metode_pembayaran');
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
        Schema::dropIfExists('tb_rfq');
    }
};
