<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTbPembayaranAddBulanTahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->integer('bulan')->unsigned()->nullable();
            $table->integer('tahun')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->dropColumn('bulan');
            $table->dropColumn('tahun');
        });
    }
}
