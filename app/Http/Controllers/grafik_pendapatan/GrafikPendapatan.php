<?php

namespace App\Http\Controllers\grafik_pendapatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class GrafikPendapatan extends Controller
{
    private $tahun;
    public function __construct() {
        $this->tahun = date("Y");
    }
    public function index(){
        
        $data = [
            "nama" => "laporan pendapatan"
        ];
        return view("laporan_pendapatan.laporan_pendapatan", $data);
    }
    
    public function getDataPembayaran(){
        try {
            $query = Pembayaran::selectRaw("tahun, sum(jml_bayar) as pendapatan, sum(tagihan) as pendapatan_seharusnya, MONTHNAME(STR_TO_DATE(bulan, '%m')) as bulan, (sum(tagihan) - sum(jml_bayar)) as status")
                                ->where("tahun", "=", $this->tahun)
                                ->groupBy("bulan")
                                ->get();
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
    public function getDataPembayaranGedung()
    {
        try {
            $query = Pembayaran::selectRaw("tb_gedung.kode_gedung as kd_gedung, nama_gedung, SUM(tb_pembayaran.jml_bayar) AS pendapatan_saat_ini, SUM(tb_pembayaran.tagihan) AS pendapatan_seharusnya")
                                ->join("tb_biodata_penghuni", "tb_biodata_penghuni.NIK", "=", "tb_pembayaran.NIK")
                                ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
                                ->where("tahun", "=", date('Y'))
                                ->groupBy("tb_kamar.kode_gedung")
                                ->get();
            return response()->json($query);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function getLaporanGedung($kode_gedung, $tahun = null)
    {
        try {
            $query = Pembayaran::selectRaw("tb_gedung.kode_gedung, nama_gedung, SUM(tb_pembayaran.jml_bayar) AS pendapatan_saat_ini, SUM(tb_pembayaran.tagihan) AS pendapatan_seharusnya, MONTHNAME(STR_TO_DATE(bulan, '%m')) as bulan")
                                ->join("tb_biodata_penghuni", "tb_biodata_penghuni.NIK", "=", "tb_pembayaran.NIK")
                                ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
                                ->where("tb_gedung.kode_gedung", "=", $kode_gedung)
                                ->where("tahun", "=", date("Y"))
                                ->groupBy("bulan");
            return view("laporan_pendapatan/laporan_pendapatan_gedung", ["pendapatan" => $query->get(), "nama" => "laporan pendapatan", "detail_gedung" => $query->first()]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function cetakLaporanGedung($kode_gedung)
    {
        try {
            $query = Pembayaran::selectRaw("tb_gedung.kode_gedung, nama_gedung, SUM(tb_pembayaran.jml_bayar) AS pendapatan_saat_ini, SUM(tb_pembayaran.tagihan) AS pendapatan_seharusnya, MONTHNAME(STR_TO_DATE(bulan, '%m')) as bulan")
                                ->join("tb_biodata_penghuni", "tb_biodata_penghuni.NIK", "=", "tb_pembayaran.NIK")
                                ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
                                ->where("tb_gedung.kode_gedung", "=", $kode_gedung)
                                ->where("tahun", "=", date("Y"))
                                ->groupBy("bulan");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Pendapatan Gedung ".$query->first()->nama_gedung.".xls");
            return view("export/cetak_laporan_pendapatan_gedung", ["pendapatan" => $query->get(), "nama" => "laporan pendapatan", "detail_gedung" => $query->first()]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
