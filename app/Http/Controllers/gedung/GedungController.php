<?php

namespace App\Http\Controllers\gedung;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GedungController extends Controller
{
    public function index(Request $request)
    {

        $data = array(
            "nama"=> "setting gedung",
            "data" => Gedung::all()
        );
        return view('setting_gedung.setting_gedung', $data);
    }

    public function store(Request $request)
    {
        $nama_gedung = $request->nama_gedung;
        $alamat_gedung = $request->alamat_gedung;
        $data = [
            'kode_gedung' => $this->getKodeGedung(),
            'nama_gedung' => $nama_gedung,
            'alamat_gedung' => $alamat_gedung
        ];
        $simpan = DB::table('tb_gedung')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }
    private function getKodeGedung()
    {   
        $newcode = "";
        $lastcode = Gedung::latest('kode_gedung')->first();
        if(Gedung::count() == 0) {
            $newcode = "G001";
        } else {
            $number = intval(substr($lastcode->kode_gedung, 1)) + 1;
            $newcode = 'G' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
    }
    public function edit(Request $request)
    {
        $kode_gedung = $request->kode_gedung;
        $gedung = DB::table('tb_gedung')->where('kode_gedung', $kode_gedung)->first();
        return view('setting_gedung.edit', compact('gedung'));
    }

    public function update($kode_gedung, Request $request)
    {
        $nama_gedung = $request->nama_gedung;
        $alamat_gedung = $request->alamat_gedung;
        $data = [
            'nama_gedung' => $nama_gedung,
            'alamat_gedung' => $alamat_gedung
        ];

        $update = DB::table('tb_gedung')->where('kode_gedung', $kode_gedung)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate!']);
        }
    }

    public function delete($kode_gedung)
    {
        $delete = DB::table('tb_gedung')->where('kode_gedung', $kode_gedung)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }
}