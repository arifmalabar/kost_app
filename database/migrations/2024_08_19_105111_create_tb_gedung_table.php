<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbGedungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_gedung', function (Blueprint $table) {
            $table->string('kode_gedung', 100)->primary();
            $table->string('nama_gedung', 200);
            $table->text('alamat_gedung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_gedung');
    }
}
