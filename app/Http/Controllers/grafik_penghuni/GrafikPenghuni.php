<?php

namespace App\Http\Controllers\grafik_penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrafikPenghuni extends Controller
{
    public function index()
    {
        $data = [
            "nama" => "grafik penghuni",
        ];
        return view("grafik_penghuni.grafik_penghuni", $data);
    }
}
