<?php

namespace App\Http\Controllers\penghuni;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Kode;
use App\Models\Kamar;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {

        $data = array(
            "nama"=> "penghuni",
            "data" => Penghuni::all(),
            "kode"=>Kamar::all()
            );
        return view('penghuni.penghuni', $data);
    }

    public function getRuanganKosong($kode_gedung)
    {
        try {
            $query = Kamar::selectRaw("tb_kamar.kode_kamar, tb_kamar.nama_ruang, tb_gedung.nama_gedung, IF(NIK IS NULL, 'tersedia', 'terisi') as status")->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_gedung.kode_gedung")->leftJoin("tb_biodata_penghuni", "tb_biodata_penghuni.kode_kamar", "=", "tb_kamar.kode_kamar")->where("tb_kamar.kode_gedung", "=", $kode_gedung)->groupBy("tb_kamar.kode_kamar")->get();
            return response()->json($query);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function detailPenghuni($id)
    {
        $data = array(
            "nama"=> "penghuni",
        );
        return view('penghuni.edit', $data);
    }
    public function getDetailPenghuniData($id)
    {
        try {
            $query = Penghuni::selectRaw("NIK, nama, email, harga, no_telp, tanggal_bergabung, nama_wali, nama_kampus_kantor, alamat_kampus_kantor, alamat, tb_kamar.kode_kamar, tb_kamar.nama_ruang")->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_kamar.kode_gedung")->where("tb_biodata_penghuni.NIK", "=", $id)->limit(1)->first();
            $query_ktp = Penghuni::selectRaw("file_ktp")->where("tb_biodata_penghuni.NIK", "=", $id)->limit(1)->first();
            $ktp = base64_encode($query_ktp->file_ktp);
            return response()->json(["biodata" => $query, "foto_ktp" => $ktp]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function halamanTambah()
    {
        $data = array(
            "nama"=> "penghuni",
        );
        return view('penghuni.tambah', $data);
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
        $ktpFileBinary = base64_decode($request->file);
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
            'kode_kamar' => $kode_kamar,
            'status' => 1,
            'file_ktp' => $ktpFileBinary
        ];
        //return response()->json(["data" => $data]);
        //$simpan = DB::table('tb_biodata_penghuni')->insert($data);
        try {
            $simpan = Penghuni::insert($data);
            if ($simpan) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
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
