<?php

namespace App\Http\Controllers\grafik_penghuni;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Http\Request;

class GrafikPenghuni extends Controller
{
    public function index()
    {
        $data = [
            "nama" => "grafik penghuni",
        ];
        return view("grafik_penghuni.grafik_penghuni", $data);
    }
    public function getDataGrafikPenghuni()
    {
        try {
            $query = Gedung::selectRaw("nama_gedung, COUNT(tb_biodata_penghuni.NIK) total_penghuni, COUNT(tb_kamar.kode_kamar) total_kamar, (COUNT(tb_kamar.kode_kamar) - COUNT(tb_biodata_penghuni.NIK)) total_kamar_kosong")
                            ->rightJoin("tb_kamar","tb_kamar.kode_gedung","=","tb_gedung.kode_gedung")
                            ->leftJoin("tb_biodata_penghuni","tb_biodata_penghuni.kode_kamar","=","tb_kamar.kode_kamar")
                            ->groupBy("tb_gedung.kode_gedung")
                            ->orderBy("total_kamar_kosong","ASC")
                            ->get();
            return response()->json($query);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
