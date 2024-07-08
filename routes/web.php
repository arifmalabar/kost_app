<?php

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

Route::get("/setting_gedung", function () {
    return view("setting_gedung/setting_gedung", ["nama"=> "setting gedung"]);
});
Route::get("/pembayaran", function () {
    return view("pembayaran.pembayaran", ["nama"=> "pembayaran"]);
});
Route::get("/bayar", function () {
    return view("pembayaran.bayar", ["nama"=> "pembayaran"]);
});