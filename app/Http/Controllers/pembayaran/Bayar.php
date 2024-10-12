<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use ErrorException;
use Illuminate\Http\Request;
use App\Helper\Kode;
use App\Models\Gedung;
use App\Models\HistoryPembayaran;

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
            "data" => Penghuni::where("NIK", $id),
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
    /*public function bayarTagihan(Request $request)
    {
        try {
            $data_penghuni = Penghuni::where("NIK", $request->NIK)->get();
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
            if(!$is_lunas && $request->jml_bayar <= $data_penghuni[0]->harga)
            {
                $data = [
                    "kode_bayar" => $this->getCustomCode(),
                    "NIK" => $request->NIK,
                    "jml_bayar" => $request->jml_bayar,
                    "metode_bayar" => $request->metode_bayar,
                    "tanggal_tagihan" => $request->tanggal_tagihan,
                    "tagihan" => $data_penghuni[0]->harga,
                ];
                $query = Pembayaran::insert($data);
                
                if(!$query)
                {
                    return response()->json(["status" => "failed", "msg" => "Transaksi Gagal"]);
                } else {
                    return response()->json(["status" => "success", "msg"=>"Berhasil menambah data transaksi"]);
                }
                
            } elseif($request->jml_bayar >= $data_penghuni[0]->harga){
                return response()->json(["status" => "failed", "msg" => "Transaksi Gagal nominal melebihi harga"]);
            } else {
                return response()->json(["status" => "failed", "msg" => "Maaf pembayaran pada tanggal ".$request->tanggal_tagihan." telah lunas"]);
            }
        } catch (\Throwable $th) {
            return response()->json(["Error" => $th]);
        }
        //$this->doUploadBukti($request);
    }*/
    public function bayarTagihan(Request $request)
    {
        try {
            $query_tagihan = Pembayaran::where('kode_bayar', $request->kode_bayar)->first();
            $query_tagihan->jml_bayar += $request->tagihan;
            $query_tagihan->tgl_bayar = date("Y-m-d H:i:s");
            $query_tagihan->save();
            //buat riwayat transaksi
            $data = [
                "no_transaksi" => $query_tagihan->no_transaksi,
                "total_transaksi" => $request->tagihan
            ];
            $query_riwayat = HistoryPembayaran::insert($data);
            return response()->json($query_tagihan);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    private function doUploadBukti($request)
    {
        return response()->json(["cek" => "oke"]);
    }
    public function getDataPembayaran($nik)
    {
        $data_penghuni = Penghuni::where("NIK", $nik)->get();
        if($data_penghuni){
            $this->getPenghuniDetail($nik);
            $i = 0;
            $dt = $this->queryTagihan($nik)->get();
            foreach ($dt as $key) {
                $this->data["list_pembayaran"][$i]['kode_bayar'] = $key->kode_bayar;
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
        //return response()->json(["st" => $nik]);
    }
    public function getDataBayarTagihan($kode_bayar)
    {
        try {
            $data_pembayaran = Pembayaran::selectRaw("YEAR(tanggal_tagihan) AS tahun, MONTHNAME(tanggal_tagihan) AS bulan")->where("kode_bayar", $kode_bayar)->first();
            return response()->json($data_pembayaran);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function getTahunTagihan($nik)
    {
        $tahun = Pembayaran::selectRaw("YEAR(tanggal_tagihan) AS tahun")->where('NIK', '=', $nik)->groupByRaw('YEAR(tanggal_tagihan)')->get();
        return response()->json($tahun);
    }
    public function getBulanTagihan($nik, $tahun)
    {
        $bulan = Pembayaran::selectRaw("MONTHNAME(tanggal_tagihan) AS nmbulan, MONTH(tanggal_tagihan) AS bulan")
                            ->where('NIK', '=', $nik)
                            ->whereYear('tanggal_tagihan', $tahun)
                            ->get();
        return response()->json($bulan);
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
    private function getPenghuniDetail($nik)
    {
        $find = Penghuni::where("NIK",$nik)->get();
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
