<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class Bayar extends Controller
{
    public function index($id)
    {
        $data = array(
            "nama"=> "Pembayaran",
            "data" => Penghuni::find($id),
        );
        return view('pembayaran.bayar', $data);
    }
    public function getDataPembayaran()
    {
        $nik = "3507241212020002";
        $data = [];
        $i = 0;
        $data = Pembayaran::select(Pembayaran::raw('* ,SUM(jml_bayar) as total'))->whereRaw(Pembayaran::raw("NIK = ".$nik.""))->groupByRaw(Pembayaran::raw("tanggal_tagihan"))->get();
        foreach ($data as $key) {
            $data[$i]['jml_bayar'] = $key->jml_bayar;
            $data[$i]['sisa_bayar'] = $this->getSisaByr($key->total, $key->jml_bayar);
            $data[$i]['status'] = $this->getStatus($data[$i]['status']);
            $data[$i]['tanggal'] = $key->tgl_bayar;
            $i++;
        }
        echo json_encode($data);
    }
    private function getSisaByr($nawal, $nakhir) : int
    {
        return $nawal - $nakhir;
    }
    private function getStatus($sisa) : string {
        if($sisa < 0)
        {
            return "lunas";
        } else{
            return "terhutang";
        }
    }
}
