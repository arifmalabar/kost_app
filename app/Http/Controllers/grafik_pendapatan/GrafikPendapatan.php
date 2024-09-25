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
}
