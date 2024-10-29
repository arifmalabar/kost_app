<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use App\Models\Gedung;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            "nama"=> "pembayaran",
            "data" => Penghuni::all()
        );
        return view('pembayaran/pembayaran', $data);
    }
    public function getDataPenghuni()
    {
        try {
            $penghuni = Penghuni::selectRaw("tb_biodata_penghuni.NIK as NIK, nama, nama_ruang as ruangan, nama_gedung as gedung")
                                ->join("tb_kamar","tb_kamar.kode_kamar","=","tb_biodata_penghuni.kode_kamar")
                                ->join("tb_gedung","tb_gedung.kode_gedung","=","tb_kamar.kode_gedung")
                                ->get();
            /*$data = [];
            $i = 0;
            foreach ($penghuni as $key) {
                $data[$i]['NIK'] = $key->NIK;
                $data[$i]['nama'] = $key->nama;
                $data[$i]['ruangan'] = $key->ruangan->nama_ruang;
                $data[$i]['gedung'] = $key->ruangan->gedung->nama_gedung;
                $i++;
            }*/
            return response()->json($penghuni);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function getDataGedung()
    {
        $data = [];
        $gedung = Gedung::where("status", "=", 1)->get();
        foreach ($gedung as $key) {
            array_push($data, $key);
        }
        return response()->json($gedung);
    }
    public function getGedungById($id)
    {
        try {
            $penghuni = Penghuni::selectRaw("NIK, nama, tb_kamar.nama_ruang as ruangan, tb_gedung.nama_gedung as gedung")->join("tb_kamar", "tb_biodata_penghuni.kode_kamar", "=", "tb_kamar.kode_kamar")->join("tb_gedung", "tb_kamar.kode_gedung", "=", "tb_gedung.kode_gedung")->where("tb_gedung.kode_gedung", "=", $id);
            return response()->json($penghuni->get());
        } catch (\Throwable $th) {
            return response()->json(["error" => $th], 500);
        }
    }
}