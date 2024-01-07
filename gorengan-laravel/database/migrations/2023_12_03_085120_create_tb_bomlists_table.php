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
        Schema::create('tb_bomlist', function (Blueprint $table) {
            $table->id('kode_bomlist');
            $table->string('kode_bom', 255);
            $table->string('kode_bahan', 255);
            $table->float('kuantitas');
            $table->string('satuan', 255);
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
        Schema::dropIfExists('tb_bomlist');
    }
};
