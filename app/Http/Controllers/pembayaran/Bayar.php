<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use ErrorException;
use Illuminate\Http\Request;
use App\Helper\Kode;
use App\Models\Gedung;

class Bayar extends Controller
{
    private $data = [];

    function __construct()
    {
        $this->data = [
            "penghuni_detail" => [],
            "list_pembayaran" => []
        ];
    }
    public function index($id)
    {
        $data = array(
            "nama"=> "Pembayaran",
            "data" => Penghuni::find($id),
        );
        return view('pembayaran.bayar', $data);
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
    public function bayarTagihan(Request $request)
    {
        $data_penghuni = Penghuni::find($request->NIK);
        $dt = [];
        $query_cek =  Pembayaran::select(Pembayaran::raw('* ,SUM(jml_bayar) as total'))->whereRaw(Pembayaran::raw("NIK = ".$request->NIK." AND tanggal_tagihan = '".$request->tanggal_tagihan."' "))->groupByRaw(Pembayaran::raw("tanggal_tagihan"))->limit(1)->get();
        $is_lunas = false;
        foreach ($query_cek as $key) {
            $this->data["list_pembayaran"]['jml_bayar'] = $key->total;
            $this->data["list_pembayaran"]['sisa_bayar'] = $this->getSisaByr($key->tagihan, $key->total);
            $this->data["list_pembayaran"]['status'] = $this->getStatus($this->data["list_pembayaran"]['sisa_bayar']);
            $this->data["list_pembayaran"]['tanggal'] = $key->tgl_bayar;
            $this->data["list_pembayaran"]['tanggal_tagihan'] = $key->tanggal_tagihan;
            if($this->getStatus($this->data["list_pembayaran"]['sisa_bayar']) == "terhutang")
            {
                $is_lunas = false;
            } else {
                $is_lunas = true;
            }
        }
        if(!$is_lunas)
        {
            $data = [
                "kode_bayar" => $this->getCustomCode(),
                "NIK" => $request->NIK,
                "jml_bayar" => $request->jml_bayar,
                "metode_bayar" => $request->metode_bayar,
                "tanggal_tagihan" => $request->tanggal_tagihan,
                "tagihan" => $data_penghuni->harga,
            ];
            $query = Pembayaran::insert($data);
            if(!$query)
            {
                return response()->json(["status" => "failed"]);
            } else {
                return response()->json(["status" => "success"]);
            }
            //return response()->json(["status" => $data]);
            
        } else {
            return response()->json(["status" => "failed", "msg" => "pembayaran anda telah lunas"]);
        }
    }
    public function getDataPembayaran($nik)
    {
        $data_penghuni = Penghuni::find($nik);
        if($data_penghuni){
            $this->getPenghuniDetail();
            $i = 0;
            $dt = $this->queryTagihan($nik)->get();
            foreach ($dt as $key) {
                $this->data["list_pembayaran"][$i]['jml_bayar'] = $key->total;
                $this->data["list_pembayaran"][$i]['sisa_bayar'] = $this->getSisaByr($key->tagihan, $key->total);
                $this->data["list_pembayaran"][$i]['status'] = $this->getStatus($this->data["list_pembayaran"][$i]['sisa_bayar']);
                $this->data["list_pembayaran"][$i]['tanggal'] = $key->tgl_bayar;
                $this->data["list_pembayaran"][$i]['tanggal_tagihan'] = $key->tanggal_tagihan;
                $i++;
            }
            echo json_encode($this->data);
        } else {
            echo json_encode(0);
        }
    }
    private function queryTagihan($nik)
    {
        return Pembayaran::select(Pembayaran::raw('* ,SUM(jml_bayar) as total'))->whereRaw(Pembayaran::raw("NIK = ".$nik.""))->groupByRaw(Pembayaran::raw("tanggal_tagihan"));
    }
    private function isLunas($nik, $tanggal)
    {
        $cek = $this->queryTagihan($nik)->whereDate($tanggal)->get();
        foreach ($cek as $key) {
            echo $key->tagihan;
        }
    }
    private function getPenghuniDetail()
    {
        $nik = "3507241212020002";
        $find = Penghuni::find($nik)->get();
        $dt= [];
        foreach ($find as $key) {
            $dt['NIK'] = $key->NIK;
            $dt['nama'] = $key->nama;
            $dt['gedung'] = $key->ruangan->gedung->nama_gedung;
            $dt['ruangan'] = $key->ruangan->nama_ruang;
            $dt['harga'] = $key->harga;
            $dt['tanggal_bergabung'] = $key->tanggal_bergabung;
        }
        $this->data["penghuni_detail"] = $dt;
    }
    private function getSisaByr($nawal, $nakhir) : int
    {
        return $nawal - $nakhir;
    }
    private function getStatus($sisa) : string {
        if($sisa == 0)
        {
            return "lunas";
        } else{
            return "terhutang";
        }
    }

}
