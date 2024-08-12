<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class Bayar extends Controller
{
    public function index($id)
    {
        $data = array(
            "nama"=> "Pembayaran",
            "data" => Penghuni::find($id),
        );
        return view('pembayaran.bayar', $data);
    }
}
