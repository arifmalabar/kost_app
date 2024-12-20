<?php

namespace App\Http\Controllers\tagihan;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
class TagihanController extends Controller
{
    private $bulan;
    private $tahun;

    public function __construct() {
        $this->bulan = date("m");
        $this->tahun = date("Y");
    }
    public function index()
    {
        $data = [
            "nama"=> "tagihan"
        ];
        return view ("tagihan.tagihan", $data);
    }
    public function getDataTagihan()
    {
        try {
            $data = Penghuni::selectRaw("tb_pembayaran.NIK, nama, no_telp, email,harga, nama_ruang, tb_gedung.kode_gedung as kode_gedung, nama_gedung, tagihan, tanggal_tagihan, (tagihan - jml_bayar) as total")
            ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
            ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
            ->join("tb_pembayaran", "tb_pembayaran.NIK","=","tb_biodata_penghuni.NIK")
            ->orderBy("tb_pembayaran.tanggal_tagihan", "DESC")
            /*->where("bulan","=", date("m"))
            ->where("tahun","=",date("Y"))*/
            ->get();
            /*$data = Pembayaran::selectRaw("tb_biodata_penghuni.NIK, nama, no_telp, email,harga, tanggal_bergabung,SUM(jml_bayar) as jml_bayar, tagihan - SUM(jml_bayar) as total, nama_ruang, nama_gedung, tagihan")
                                ->join("tb_biodata_penghuni","tb_biodata_penghuni.NIK","=","tb_pembayaran.NIK")                    
                                ->join("tb_kamar","tb_kamar.kode_kamar","=","tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung","tb_gedung.kode_gedung","=","tb_kamar.kode_kamar")
                                ->whereMonth('tanggal_tagihan', date('m'))
                                ->whereYear('tanggal_tagihan', date('Y'))
                                ->get();*/
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    
    public function tambahTagihan(Request $request)
    {
        $req_data = [
            "tahun" => $request->tahun,
            "bulan" => $request->bulan,
            "gedung" => $request->gedung
        ];
        $data_penghuni = [];
        try {
            $query_penghuni = Penghuni::selectRaw("NIK, nama, harga, DAY(tanggal_bergabung) AS tgl, tb_gedung.kode_gedung, tb_kamar.kode_kamar")
                                    ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                    ->join("tb_gedung","tb_kamar.kode_gedung", "=","tb_gedung.kode_gedung")
                                    ->where("tb_gedung.kode_gedung", "=", $req_data["gedung"])
                                    ->where("status", "!=", 0)
                                    ->whereRaw("NOT EXISTS (SELECT NIK FROM tb_pembayaran WHERE NIK = tb_biodata_penghuni.NIK AND bulan = ".$req_data["bulan"]." AND tahun = ".$req_data["tahun"].")");

            $data_penghuni = $query_penghuni->get();
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        
        $data_tagihan = [];
        $idx = 0;
        foreach ($data_penghuni as $key) {
            $datestring  = $req_data["tahun"]."-".$req_data["bulan"]."-".$key->tgl;
            $date = date('Y-m-d', strtotime($datestring));
            $no_transaksi = $req_data["tahun"]."-".$req_data["bulan"]."/".$key->kode_gedung."/".$key->kode_kamar."/".$key->NIK;
            $kode_bayar  = "P".$key->NIK."".$req_data["tahun"]."".$req_data["bulan"]."".$key->kode_kamar;
            $data_tagihan[$idx] = [
                "kode_bayar" => $kode_bayar,
                "no_transaksi" => $no_transaksi,
                "NIK" => $key->NIK,
                "tagihan" => $key->harga,
                "tanggal_tagihan" => $date,
                "bulan" => $req_data["bulan"],
                "tahun" => $req_data["tahun"],
            ];
            $idx++;
        }
        try {
            $query_insert = Pembayaran::insert($data_tagihan);
            if($query_insert){
                return response()->json(["status" => "success"]);
            } else {
                return response()->json(["status" => "failed"]);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function sortTagihan(Request $request)
    {
        try {
            $data = Penghuni::selectRaw("tb_pembayaran.NIK, nama, no_telp, email,harga, nama_ruang, tb_gedung.kode_gedung as kode_gedung, nama_gedung, tagihan, tanggal_tagihan, (tagihan - jml_bayar) as total")
            ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
            ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
            ->join("tb_pembayaran", "tb_pembayaran.NIK","=","tb_biodata_penghuni.NIK")
            ->orderBy("tb_biodata_penghuni.tanggal_bergabung", "ASC")
            ->where("bulan","=", $request->bulan)
            ->where("tahun","=",$request->tahun)
            ->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        
    }

    private function getCustomCode()
    {
        $newcode = "";
        $lastcode = Pembayaran::latest('kode_bayar')->first();
        if(Pembayaran::count() == 0) {
            $newcode = "P"."001";
        } else {
            $number = intval(substr($lastcode->kode_bayar, 1)) + 1;
            $newcode = "P" . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
    }

}
