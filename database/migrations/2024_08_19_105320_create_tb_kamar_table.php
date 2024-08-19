<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kamar', function (Blueprint $table) {
            $table->string("kode_kamar", 100)->primary();
            $table->string("kode_gedung", 100);
            $table->string("nama_ruang", 200);
            $table->integer("no_ruang")->unsigned();
            $table->integer("kapasitas")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kamar');
    }
}
