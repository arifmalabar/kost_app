<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    private $year;
    private $month;
    public function __construct() {
        $this->year = date("Y");
        $this->month = date("m");
    }
    public function index()
    {
        return view('dashboard/dashboard', ["nama" => "dashboard"]);
    }
    public function informasiKostJSon()
    {
        $data = [
            "informasi_kost" => $this->getInformasiKost(),
            "informasi_penghuni"=> $this->getInformasiPenghuniBaru(),
            "cicilan" => $this->getTotalCicilan()->cicilan,
            "lunas" => $this->getTotalLunas()->lunas,
            "sisa_bayar" => $this->getSisaBayar(), 
            "grafik_lunas" => $this->grafikLunas(),
            "grafik_terhutang" => $this->grafikTerhutang(),
            "penghuni" => $this->getPenghuniBaru(),
            "ketersediaan" => $this->getKetersediaanKamar(),
        ];
        return response()->json($data);
    }
    private function getInformasiKost(){
        try {
            $count_penghuni = Penghuni::get()->count();
            $count_gedung = Gedung::get()->count();
            $count_kamar = Kamar::get()->count();
            $data = [
                "jml_penghuni" => $count_penghuni,
                "jml_gedung" => $count_gedung,
                "jml_kamar" => $count_kamar,
            ];
            return $data;
        } catch (\Throwable $th) {
            $data = [
                "jml_penghuni" => 0,
                "jml_gedung" => 0,
                "jml_kamar" => 0,
                "error" => $th->getMessage(),
            ];
            return $data;
        }
    }
    private function getTotalCicilan(){
        try {
            $query = Pembayaran::selectRaw("SUM(jml_bayar) AS cicilan")->whereRaw("jml_bayar < tagihan")->first();
            return $query;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    private function getTotalLunas(){
        try {
            $query = Pembayaran::selectRaw("SUM(jml_bayar) AS lunas")->whereRaw("jml_bayar >= tagihan")->first();
            return $query;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    private function getSisaBayar()
    {
        $lunas = $this->getTotalLunas()->lunas;
        $cicilan = $this->getTotalCicilan()->cicilan;
        return $lunas - $cicilan;
    }
    private function getInformasiPenghuniBaru(){
        try {
            $query = Penghuni::whereMonth("tanggal_bergabung", date('m'))->get();
            //query ketersedian kamar
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
    private function grafikLunas()
    {
        try {
            $query = Pembayaran::selectRaw("SUM(jml_bayar) as lunas, MONTHNAME(STR_TO_DATE(bulan, '%m')) as bulan")
                                ->whereRaw("tahun = ".$this->year." AND jml_bayar >= tagihan")
                                ->groupBy("bulan")
                                ->get();
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
    private function grafikTerhutang()
    {
        try {
            $query = Pembayaran::selectRaw("SUM(jml_bayar) as hutang, MONTHNAME(STR_TO_DATE(bulan, '%m')) as bulan")
                                ->whereRaw("tahun = ".$this->year." AND jml_bayar <= tagihan")
                                ->groupBy("bulan")
                                ->get();
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
    private function getPenghuniBaru(){
        try {
            $query = Penghuni::selectRaw("NIK, nama, nama_ruang, nama_gedung, tanggal_bergabung")
                                ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung", "tb_kamar.kode_gedung", "=", "tb_gedung.kode_gedung")
                                ->whereMonth("tanggal_bergabung", $this->month)
                                ->get();
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
    private function getKetersediaanKamar()
    {
        try {
            $kosong = Penghuni::rightJoin('tb_kamar', 'tb_kamar.kode_kamar', '=', 'tb_biodata_penghuni.kode_kamar')
                            ->leftJoin('tb_gedung', 'tb_kamar.kode_gedung', '=', 'tb_gedung.kode_gedung')
                            ->whereNull('NIK')
                            ->orWhere('status', '=', 0)
                            ->count();

                            // Menghitung jumlah kamar terisi
            $terisi = Penghuni::rightJoin('tb_kamar', 'tb_kamar.kode_kamar', '=', 'tb_biodata_penghuni.kode_kamar')
                            ->leftJoin('tb_gedung', 'tb_kamar.kode_gedung', '=', 'tb_gedung.kode_gedung')
                            ->whereNotNull('NIK')
                            ->where('status', '=', 1)
                            ->count();

            // Menggabungkan hasil
            $result = [
                'kosong' => $kosong,
                'terisi' => $terisi,
            ];
            return $result;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
