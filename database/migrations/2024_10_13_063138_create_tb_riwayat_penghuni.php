<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRiwayatPenghuni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_riwayat_penghuni', function (Blueprint $table) {
            $table->string('NIK', 255);
            $table->string('kode_kamar', 100);
            $table->integer("status")->length(5)->unsigned();
            $table->timestamp("waktu")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_riwayat_penghuni');
    }
}
