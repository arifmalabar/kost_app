<?php

namespace App\Http\Controllers\penghuni;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Kode;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {

        $data = array(
            "nama"=> "setting penghuni",
            "data" => Penghuni::all()
        );
        return view('penghuni.penghuni', $data);
    }

    public function store(Request $request)
    {
        $NIK= $request->NIK;
        $nama = $request->nama;
        $email= $request->email;
        $harga = $request->harga ;
        $no_telp= $request->no_telp;
        $nama_wali = $request->nama_wali;
        $nama_kampus_kantor= $request->nama_kampus_kantor;
        $alamat_kampus_kantor = $request->alamat_kampus_kantor;
        $status= $request->status;
        $alamat = $request->alamat;
        $kode_kamar= $request->kode_kamar;
        $data = [
            'NIK' => $NIK,
            'nama' => $nama,
            'email' => $email,
            'harga' => $harga,
            'no_telp' => $no_telp,
            'nama_wali' => $nama_wali,
            'nama_kampus_kantor' => $nama_kampus_kantor,
            'alamat_kampus_kantor' => $alamat_kampus_kantor,
            'status' => $status,
            'alamat' => $alamat,
            'kode_kamar' => $kode_kamar

        ];
        $simpan = DB::table('tb_biodata_penghuni')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }
    public function edit(Request $request)
    {
        $NIK = $request->NIK;
        $data = array(
            "nama"=> "setting penghuni",
            "data" => DB::table('tb_biodata_penghuni')->where('NIK', $NIK)->first(),
        );
        return view('penghuni_ruang.edit', $data);
    }
    public function update($NIK, Request $request)
    {
        $NIK= $request->NIK;
        $nama = $request->nama;
        $email= $request->email;
        $harga = $request->harga ;
        $no_telp= $request->no_telp;
        $nama_wali = $request->nama_wali;
        $nama_kampus_kantor= $request->nama_kampus_kantor;
        $alamat_kampus_kantor = $request->alamat_kampus_kantor;
        $status= $request->status;
        $alamat = $request->alamat;
        $kode_kamar= $request->kode_kamar;
        $data = [
            'NIK' => $NIK,
            'nama' => $nama,
            'email' => $email,
            'harga' => $harga,
            'no_telp' => $no_telp,
            'nama_wali' => $nama_wali,
            'nama_kampus_kantor' => $nama_kampus_kantor,
            'alamat_kampus_kantor' => $alamat_kampus_kantor,
            'status' => $status,
            'alamat' => $alamat,
            'kode_kamar' => $kode_kamar
        ];

        $update = DB::table('tb_biodata_penghuni')->where('NIK', $NIK)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate!']);
        }
    }

    public function delete($NIK)
    {
        $delete = DB::table('tb_biodata_penghuni')->where('NIK', $NIK)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }
}
