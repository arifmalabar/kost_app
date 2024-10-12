<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Kode;
use App\Models\Penghuni;

public function show($kode_gedung)
{
    $gedung = DB::table('tb_gedung')->where('kode_gedung', $kode_gedung)->first();

    // Jika ingin menampilkan data penghuni yang ada di gedung tersebut
    $penghuni = DB::table('tb_penghuni')->where('kode_gedung', $kode_gedung)->get();

    return view('gedung_penghuni.show', compact('gedung', 'penghuni'));
}