<?php


use App\Http\Controllers\gedung\GedungController;
use App\Http\Controllers\pembayaran\Bayar;
use App\Http\Controllers\pembayaran\PembayaranController;
use App\Models\Penghuni;
use App\Http\Controllers\penghuni\PenghuniController;
use Illuminate\Support\Facades\Route;

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

Route::controller(GedungController::class)->group(function () {
    Route::get('/setting_gedung', 'index')->name('gedung.index');
    Route::post('/setting_gedung/store', 'store')->name('gedung.store');
    Route::get('/setting_gedung/{kode_gedung}/edit', 'edit')->name('gedung.edit');
    Route::put('/setting_gedung/{kode_gedung}/update', 'update')->name('gedung.update');
    Route::delete('/setting_gedung/{kode_gedung}/delete', 'delete')->name('gedung.delete');
});

Route::controller(PenghuniController::class)->group(function () {
    Route::get('/penghuni_ruang', 'index')->name('penghuni.index');
    Route::post('/penghuni_ruang/store', 'store')->name('penghuni.store');
    Route::get('/penghuni_ruang/{NIK}/edit', 'edit')->name('penghuni.edit');
    Route::put('/penghuni_ruang/{NIK}/update', 'update')->name('penghuni.update');
    Route::delete('/penghuni_ruang/{NIK}/delete', 'delete')->name('penghuni.delete');

});

Route::get("/setting_ruangan", function () {
    return view("setting_ruangan/setting_ruangan", ["nama"=> "setting ruangan"]);
});

Route::controller(PembayaranController::class)->group(function() {
    Route::get('/pembayaran', 'index');
    Route::get('/get_gedung', 'getDataGedung');
    Route::get('/get_gedung_byid/{id}', 'getGedungById');
    Route::get('/get_penghuni', 'getDataPenghuni');
});

Route::get("/tagihan", function () {
    return view ("tagihan.tagihan", ["nama"=> "tagihan"]);
});

Route::controller(Bayar::class)->group(function () {
    Route::get("/bayar/{id}", 'index');
    Route::get("/get_bayar/{nik}", 'getDataPembayaran');
    Route::post("/bayar_tagihan", "bayarTagihan");
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

// Route::get("/penghuni_ruang", function () {
//     return view("penghuni/penghuni", ["nama"=> "penghuni ruang"]);
// });

Route::get("/pindah_ruang", function () {
    return view("pindah_ruang/pindahruang", ["nama"=> "pindah ruang"]);
});

Route::get("/laporan_pendapatan", function(){
    return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"]);
});
