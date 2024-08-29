<?php

namespace App\Http\Controllers\tagihan;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
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
            $data = Penghuni::selectRaw("tb_biodata_penghuni.NIK, nama, no_telp, email,harga, tanggal_bergabung,SUM(jml_bayar) as jml_bayar, tagihan - SUM(jml_bayar) as total, nama_ruang, nama_gedung, tagihan")
            ->leftJoin("tb_pembayaran", function($join) {
                $join->on("tb_biodata_penghuni.NIK", "=", "tb_pembayaran.NIK")->whereMonth("tb_pembayaran.tanggal_tagihan", date('m'))->whereYear("tb_pembayaran.tanggal_tagihan", date('Y'));
            })
            ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
            ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")
            ->groupBy("tb_biodata_penghuni.NIK")
            ->orderBy("tb_biodata_penghuni.tanggal_bergabung", "ASC")
            ->get();
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
            $query_penghuni = Penghuni::selectRaw("NIK, nama, harga, DAY(tanggal_bergabung) AS tgl, tb_gedung.kode_gedung")
                                    ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                    ->join("tb_gedung","tb_kamar.kode_gedung", "=","tb_gedung.kode_gedung")
                                    ->where("tb_gedung.kode_gedung", "=", $req_data["gedung"])
                                    ->get();
            $data_penghuni = $query_penghuni;
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        $data_tagihan = [];
        $idx = 0;
        foreach ($data_penghuni as $key) {
            $data_tagihan[$idx] = [
                "NIK" => $key->NIK,
                "tagihan" => $key->harga,
                "tanggal_tagihan" => $req_data["tahun"]."-".$req_data["bulan"]."-".$key->tgl
            ];
            $idx++;
        }
        return response()->json($data_tagihan);
        //bagian insert data
    }
}
