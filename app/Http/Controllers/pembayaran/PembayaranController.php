<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use Illuminate\Http\Request;

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
            "nama"=> "setting ruangan",
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
}