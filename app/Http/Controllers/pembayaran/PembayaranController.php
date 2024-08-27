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
        $penghuni = Penghuni::get();
        $data = [];
        $i = 0;
        foreach ($penghuni as $key) {
            $data[$i]['NIK'] = $key->NIK;
            $data[$i]['nama'] = $key->nama;
            $data[$i]['ruangan'] = $key->ruangan->nama_ruang;
            $data[$i]['gedung'] = $key->ruangan->gedung->nama_gedung;
            $i++;
        }
        echo json_encode($data);
    }
    public function getDataGedung()
    {
        $data = [];
        $gedung = Gedung::all();
        foreach ($gedung as $key) {
            array_push($data, $key);
        }
        return response()->json($data);
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