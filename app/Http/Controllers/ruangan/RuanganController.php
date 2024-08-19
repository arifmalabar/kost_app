<?php

namespace App\Http\Controllers\ruangan;

use App\Helper\Kode;
use App\Models\Kamar;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RuanganController extends Controller
{
    public function index()
{
    $data = array(
        "nama"=> "setting ruangan",
        "data" => Kamar::all(),
        "gedung"=>Gedung::all()
    );
    return view('setting_ruangan.setting_ruangan', $data);
}


    public function store(Request $request)
    {
        $kode_gedung = $request->kode_gedung;
        $nama_ruang = $request->nama_ruang;
        $no_ruang = $request->no_ruang;
        $kapasitas = $request->kapasitas;

        $data=[
            'kode_kamar' => $this->getCustomCode(),
            'kode_gedung' => $kode_gedung,
            'nama_ruang' => $nama_ruang,
            'no_ruang' => $no_ruang,
            'kapasitas' => $kapasitas
        ];
        try {
            $simpan = DB::table('tb_kamar')->insert($data);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }
    private function getCustomCode()
    {
        $newcode = "";
        $lastcode = Kamar::latest('kode_kamar')->first();
        if(Kamar::count() == 0) {
            $newcode = "K"."001";
        } else {
            $number = intval(substr($lastcode->kode_kamar, 1)) + 1;
            $newcode = "K" . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
    }
    public function edit($kode_kamar)
    {
        $data = array(
            "nama"=> "setting ruangan",
        );
        $ruangan = Kamar::where('kode_kamar', $kode_kamar)->first();
        $gedung = Gedung::all();
        return view('setting_ruangan.edit', compact('data','ruangan', 'gedung'));
    }

    public function update($kode_kamar, Request $request)
    {
        $kode_gedung = $request->kode_gedung;
        $nama_ruang = $request->nama_ruang;
        $no_ruang = $request->no_ruang;
        $kapasitas = $request->kapasitas;

        $data=[
            'kode_gedung' => $kode_gedung,
            'nama_ruang' => $nama_ruang,
            'no_ruang' => $no_ruang,
            'kapasitas' => $kapasitas
        ];
        $update = DB::table('tb_kamar')->where('kode_kamar', $kode_kamar)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate!']);
        }
    }

    public function delete($kode_kamar)
    {
        $delete = DB::table('tb_kamar')->where('kode_kamar', $kode_kamar)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }
}