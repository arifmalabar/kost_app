<?php


use App\Models\Penghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pembayaran\Bayar;
use App\Http\Controllers\gedung\GedungController;
use App\Http\Controllers\ruangan\RuanganController;
use App\Http\Controllers\penghuni\PenghuniController;
use App\Http\Controllers\pembayaran\PembayaranController;
use App\Http\Controllers\tagihan\TagihanController;
use App\Http\Controllers\Login\LoginController;


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

Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
})->name('dashboard');

Route::controller(GedungController::class)->group(function () {
    //Route::get('/setting_gedung', 'index')->name('admin.gedung.index')->middleware('auth');
    Route::get('/setting_gedung', 'index')->name('admin.gedung.index');
    Route::post('/setting_gedung/store', 'store')->name('gedung.store');
    Route::get('/setting_gedung/{kode_gedung}/edit', 'edit')->name('gedung.edit');
    Route::put('/setting_gedung/{kode_gedung}/update', 'update')->name('gedung.update');
    Route::delete('/setting_gedung/{kode_gedung}/delete', 'delete')->name('gedung.delete');
});

Route::controller(RuanganController::class)->group(function () {
    Route::get('/setting_ruangan', 'index')->name('ruangan.index');
    Route::post('/setting_ruangan/store', 'store')->name('ruangan.store');
    Route::get('/setting_ruangan/{kode_kamar}/edit', 'edit')->name('ruangan.edit');
    Route::put('/setting_ruangan/{kode_kamar}/update', 'update')->name('ruangan.update');
    Route::delete('/setting_ruangan/{kode_kamar}/delete', 'delete')->name('ruangan.delete');
});

Route::controller(PenghuniController::class)->group(function () {
    Route::get('/penghuni_ruang', 'index')->name('penghuni.index');
    Route::get('/penghuni_ruang/status_ruangan/{id}', 'getRuanganKosong')->name('penghuni.getRuanganKosong');
    Route::get('/penghuni_ruang/tambah_penghuni', 'halamanTambah')->name('penghuni.halamanTambah');
    Route::get('/penghuni_ruang/detail_penghuni/{id}', 'detailPenghuni')->name('penghuni.detailPenghuni');
    Route::get('/penghuni_ruang/getDetailPenghuniData/{id}', 'getDetailPenghuniData')->name('penghuni.getDetailPenghuniData');
    Route::get('/penghuni_ruang/update_penghuni', 'halamanTambah')->name('penghuni.halamanTambah');
    Route::post('/penghuni_ruang/store', 'store')->name('penghuni.store');
    Route::get('/penghuni_ruang/{NIK}/edit', 'edit')->name('penghuni.edit');
    Route::put('/penghuni_ruang/{NIK}/update', 'update')->name('penghuni.update');
    Route::delete('/penghuni_ruang/{NIK}/delete', 'delete')->name('penghuni.delete');

});

Route::controller(PembayaranController::class)->group(function() {
    Route::get('/pembayaran', 'index');
    Route::get('/get_gedung', 'getDataGedung');
    Route::get('/get_gedung_byid/{id}', 'getGedungById');
    Route::get('/get_penghuni', 'getDataPenghuni');
});

Route::controller(TagihanController::class)->group(function(){
    Route::get("/tagihan", 'index');
    Route::get("/data_tagihan", 'getDataTagihan');
});

Route::controller(Bayar::class)->group(function () {
    Route::get("/bayar/{id}", 'index');
    Route::get("/get_bayar/{nik}", 'getDataPembayaran');
    Route::post("/bayar_tagihan", "bayarTagihan");
});



// Route::get("/login", function() {
//     return view("login/login", ["nama"=> "login"]);
// });

// Route::get('/register', function () {
//     return view("register/register", ["nama"=> "register"]);
// });

Route::get("/profile", function(){
    return view("profile/profile", ["nama"=> "profile"]);
})->name('profile')->middleware('auth');

// Route::get("/penghuni_ruang", function () {
//     return view("penghuni/penghuni", ["nama"=> "penghuni ruang"]);
// });

// Route::get("/pindah_ruang", function () {
//     return view("pindah_ruang/pindahruang", ["nama"=> "pindah ruang"]);
// });

Route::get("/laporan_pendapatan", function(){
    //return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"])->middleware('auth');
    return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"]);
});
