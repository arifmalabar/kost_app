<?php

use App\Http\Controllers\pembayaran\Bayar;
use App\Http\Controllers\pembayaran\PembayaranController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controller\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
});

Route::get("/setting_gedung", function () {
    return view("setting_gedung/setting_gedung", ["nama"=> "setting gedung"]);
});

Route::get("/setting_ruangan", function () {
    return view("setting_ruangan/setting_ruangan", ["nama"=> "setting ruangan"]);
});

Route::controller(PembayaranController::class)->group(function() {
    Route::get('/pembayaran', 'index');
    Route::get('/get_penghuni', 'getDataPenghuni');
});

Route::get("/tagihan", function () {
    return view ("tagihan.tagihan", ["nama"=> "tagihan"]);
}); 

Route::controller(Bayar::class)->group(function () {
    Route::get("/bayar/{id}", 'index');
});
Route::get("/login", function() {
    return view("login/login", ["nama"=> "login"]);
});

Route::get('/register', function () {
    return view("register/register", ["nama"=> "register"]);
});

Route::get("/profile", function(){
    return view("profile/profile", ["nama"=> "profile"]);
});

Route::get("/penghuni_ruang", function () {
    return view("penghuni/penghuni", ["nama"=> "penghuni ruang"]);
});

Route::get("/pindah_ruang", function () {
    return view("pindah_ruang/pindahruang", ["nama"=> "pindah ruang"]);
});
Route::get("/laporan_pendapatan", function(){
    return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"]);
});