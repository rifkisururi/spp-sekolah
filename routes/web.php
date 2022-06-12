<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Kelas;
use App\Http\Controllers\Spp;
use App\Http\Controllers\Periode;
use App\Http\Controllers\Siswa;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/',[CustomAuthController:: class,'index'])->name('login');
Route::get('login',[CustomAuthController:: class,'index'])->name('login');
Route::get('registration',[CustomAuthController:: class,'registration'])->name('registration');
Route::POST('custom-registration',[CustomAuthController:: class,'customRegistration'])->name('custom.registration');
Route::POST('custom-login',[CustomAuthController:: class,'customLogin'])->name('custom.login');
Route::get('logout',[CustomAuthController:: class,'logOut'])->name('logout');

Route::get('dashboard',[Dashboard:: class,'index'])->name('dashboard');

// kelas
Route::get('kelas',[Kelas:: class,'index'])->name('kelas');
Route::POST('kelas/store',[Kelas:: class,'store']);
Route::POST('kelas/update',[Kelas:: class,'update']);
Route::POST('kelas/hapus',[Kelas:: class,'hapus']);


// siswa
Route::get('siswa',[Siswa:: class,'index'])->name('siswa');
Route::POST('siswa/store',[Siswa:: class,'store']);
Route::POST('siswa/update',[Siswa:: class,'update']);
Route::POST('siswa/hapus',[Siswa:: class,'hapus']);

// periode
 Route::get('periode',[Periode:: class,'index'])->name('periode');
Route::POST('periode/store',[Periode:: class,'store']);
Route::POST('periode/update',[Periode:: class,'update']);
Route::POST('periode/hapus',[Periode:: class,'hapus']);

// spp
Route::get('spp',[Spp:: class,'index'])->name('spp');
Route::POST('spp/store',[Spp:: class,'store']);
Route::POST('spp/update',[Spp:: class,'update']);
Route::POST('spp/hapus',[Spp:: class,'hapus']);
