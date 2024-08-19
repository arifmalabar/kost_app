<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBiodataPenghuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_biodata_penghuni', function (Blueprint $table) {
            $table->char("NIK", 255)->primary();
            $table->char("kode_kamar", 100);
            $table->string("nama", 200);
            $table->string("email", 200);
            $table->integer("harga")->length(20)->unsigned();
            $table->string("no_telp", 200);
            $table->date("tanggal_bergabung")->useCurrent();
            $table->string("nama_wali", 200);
            $table->string("nama_kampus_kantor", 200);
            $table->string("alamat_kampus_kantor", 200);
            $table->string("alamat");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_biodata_penghuni');
    }
}
