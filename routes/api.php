<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\penghuni\PenghuniController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
    Route::put('/penghuni_ruang/update', 'update')->name('penghuni.update');
    Route::delete('/penghuni_ruang/{NIK}/delete', 'delete')->name('penghuni.delete');

});
