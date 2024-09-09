<?php

namespace App\Http\Controllers\grafik_pendapatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class GrafikPendapatan extends Controller
{
    public function index(){
        $data = [
            "data_pembayaran" => $this->getDataPembayaran(),
            "nama" => "tagihan"
        ];
        return view("", $data);
    }
    
    public function getDataPembayaran(){
        try {
            $query = Pembayaran::selectRaw("tahun, bulan, sum(jml_bayar) as total_tagihan, 	sum(tagihan) as tagihan_seharusnya")
                                ->where("tahun", "=", 2024)
                                ->groupBy("bulan")
                                ->get();
            return $query;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
