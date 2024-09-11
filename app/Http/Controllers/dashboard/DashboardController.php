<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            "informasi_kost" => $this->getInformasiKost(),
            "informasi_penghuni"=> $this->getInformasiPenghuniBaru()
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
    private function getTotalBiayaTagihan(){

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
}
