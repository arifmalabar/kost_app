<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->string("kode_bayar", 500)->primary();
            $table->char("NIK", 255);
            $table->integer("jml_bayar")->length(255)->unsigned();
            $table->timestamp("tgl_bayar")->useCurrent();
            $table->enum("metode_bayar", ["tunai", "transfer"]);
            $table->string("bukti_bayar", 1000);
            $table->integer("tagihan")->length(255)->unsigned();
            $table->date("tanggal_tagihan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pembayaran');
    }
}
