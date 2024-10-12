<?php

namespace App\Http\Controllers\gedung;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Kode;
use App\Models\Penghuni;
use Exception;

class GedungController extends Controller
{
    public function index()
    {

        $data = array(
            "nama"=> "setting gedung",
            "data" => Gedung::all()
        );
        return view('setting_gedung.setting_gedung', $data);
    }

    public function exportExcel($kode_gedung)
    {
        try {
            $query_gedung = Gedung::find($kode_gedung);
            $query_penghuni = Penghuni::selectRaw("NIK, nama, tb_kamar.nama_ruang, status")
                                            ->join("tb_kamar", 'tb_kamar.kode_kamar', "=", "tb_biodata_penghuni.kode_kamar")
                                            ->whereRaw("kode_gedung = '".$query_gedung->kode_gedung."'")
                                            ->get();
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Penghuni Gedung ".$query_gedung->nama_gedung.".xls");
            return view("export.penghuni_export", ["data_penghuni" => $query_penghuni, "data_gedung" => $query_gedung]);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "msg" => $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $nama_gedung = $request->nama_gedung;
        $alamat_gedung = $request->alamat_gedung;
        $data = [
            'kode_gedung' => Kode::getCustomCode(new Gedung(), "G", 'kode_gedung'),
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
    public function edit(Request $request)
    {
        $kode_gedung = $request->kode_gedung;
        $data = array(
            "nama"=> "setting gedung",
            "gedung" => DB::table('tb_gedung')->where('kode_gedung', $kode_gedung)->first(),
        );
        return view('setting_gedung.edit', $data);
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