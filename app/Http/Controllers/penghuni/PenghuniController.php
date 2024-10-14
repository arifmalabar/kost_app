<?php

namespace App\Http\Controllers\penghuni;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Kode;
use App\Models\Kamar;
use App\Models\Pembayaran;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {

        $data = array(
            "nama"=> "penghuni",
            "data" => Penghuni::where("status", "=", 1)->get(),
            "kode"=>Kamar::all()
            );
        return view('penghuni.penghuni', $data);
    }

    public function getPenghuniByGedung($kode_gedung)
    {
        try {
            $query = Penghuni::join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                ->where("status", "=", 1)
                                ->where("kode_gedung", "=", $kode_gedung)
                                ->get();
            return response()->json($query);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getRuanganKosong($kode_gedung)
    {
        try {
            /*$query = Kamar::selectRaw("tb_kamar.kode_kamar, tb_kamar.nama_ruang, tb_gedung.nama_gedung, IF(NIK IS NULL, 'tersedia', 'terisi') as status")
                            ->join("tb_gedung", "tb_gedung.kode_gedung", "=", "tb_gedung.kode_gedung")
                            ->leftJoin("tb_biodata_penghuni", "tb_biodata_penghuni.kode_kamar", "=", "tb_kamar.kode_kamar")
                            ->where("tb_kamar.kode_gedung", "=", $kode_gedung)
                            ->groupBy("tb_kamar.kode_kamar")
                            ->get();*/
            $query = Kamar::selectRaw("tb_kamar.kode_kamar, tb_kamar.nama_ruang, 
                            (
                                CASE 
                                    WHEN (SELECT NIK FROM tb_biodata_penghuni WHERE kode_kamar = tb_kamar.kode_kamar AND status = 1) IS NULL THEN 'tersedia' 
                                    WHEN (SELECT NIK FROM tb_biodata_penghuni WHERE kode_kamar = tb_kamar.kode_kamar AND status = 1) IS NOT NULL THEN 'terisi' END
                            ) AS status")
                            ->where("kode_gedung", "=", $kode_gedung)
                            ->get();
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
        $tgl_bergabung = $request->tanggal_bergabung;
        $ktpFileBinary = base64_encode($request->file);
        $data = [];
        if($ktpFileBinary != "")
        {
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
                'file_ktp' => $ktpFileBinary,
                "tanggal_bergabung" => $tgl_bergabung,
            ];
        } else {
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
                "tanggal_bergabung" => $tgl_bergabung,
            ];
        }
        try {
            $simpan = Penghuni::insert($data);
            //$tagihan = $this->buatTagihanBaru($NIK);
            if ($simpan) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    private function buatTagihanBaru($nik)
    {
        try {
            $key = Penghuni::selectRaw("NIK, nama, harga, YEAR(tanggal_bergabung) AS tahun, MONTH(tanggal_bergabung) AS bulan,DAY(tanggal_bergabung) AS tgl, tb_gedung.kode_gedung, tb_kamar.kode_kamar")
                                    ->join("tb_kamar", "tb_kamar.kode_kamar", "=", "tb_biodata_penghuni.kode_kamar")
                                    ->join("tb_gedung","tb_kamar.kode_gedung", "=","tb_gedung.kode_gedung")
                                    ->where("NIK", "=", $nik)
                                    ->first();
            $no_transaksi = $key->tahun."-".$key->bulan."/".$key->kode_gedung."/".$key->kode_kamar."/".$key->NIK;
            $kode_bayar  = "P".$key->NIK."".$key->tahun."".$key->bulan."".$key->kode_kamar;
            $data_tagihan = [
                "kode_bayar" => $kode_bayar,
                "no_transaksi" => $no_transaksi,
                "NIK" => $key->NIK,
                "tagihan" => $key->harga,
                "tanggal_tagihan" => $key->tahun."-".$key->bulan."-".$key->tgl
            ];
            $query = Pembayaran::insert($data_tagihan);
            return $query;
        } catch (\Throwable $th) {
            return $th;
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
    public function update(Request $request)
    {
        try {
        $data = [];
            /*
            $NIK= $request->NIK;
            $oldNIK = $request->oldNIK;
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
            $ktpFileBinary = base64_encode($request->file);
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
                'file_ktp' => $ktpFileBinary
            ];*/
        $NIK= $request->NIK;
        $old_nik = $request->old_nik;
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
        $ktpFileBinary = base64_encode($request->file);
        if($ktpFileBinary != "")
        {
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
        } else {
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
            ];
        }
            $update = Penghuni::where('NIK', $old_nik)->update($data);
            if($update){
                return response()->json(["status" => "success", "msg" => "berhasil menambah mengubah data"]);
            }else{
                return response()->json(["status"=> "error", "msg" => "terjadi kesalahan"]);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function delete($NIK)
    {
        //$delete = DB::table('tb_biodata_penghuni')->where('NIK', $NIK)->delete();
        try {
            $penghuni_query = Penghuni::find($NIK);
            $penghuni_query->status = 0;
            $penghuni_query->save();
        } catch (\Throwable $th) {
            return $th;
        }
    }



public function showPenghuni($kode_gedung)
{
    // Mengambil data penghuni berdasarkan kode_gedung
    $penghuni = Penghuni::join('tb_kamar', 'tb_kamar.kode_kamar', '=', 'tb_biodata_penghuni.kode_kamar')
        ->where('tb_kamar.kode_gedung', '=', $kode_gedung)
        ->select('tb_biodata_penghuni.*')
        ->get();
    if ($penghuni->isEmpty()) {

        return view('penghuni.index', ['penghuni' => [], "nama"=> "gedung penghuni", 'message' => 'Tidak ada penghuni ditemukan.']);
    }

    return view('penghuni.index', ["nama"=> "gedung penghuni", "penghuni" => $penghuni]);
}



}
