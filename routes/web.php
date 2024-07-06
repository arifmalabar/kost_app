<?php

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

Route::get("/login", function() {
    return view("login/login", ["nama"=> "login"]);
});

Route::get('/register', function () {
    return view("register/register", ["nama"=> "register"]);
});

Route::get("/profile", function(){
    return view("profile/profile", ["nama"=> "profile"]);
});