<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/', [App\Http\Controllers\PagesController::class, 'dashboard']);
Route::get('/register_homestay', [App\Http\Controllers\AdminController::class, 'register_homestay']);
Route::get('/list', [App\Http\Controllers\PagesController::class, 'listHomestay']);
Route::get('/home', [App\Http\Controllers\PagesController::class, 'home']);


Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'admin']);
    // Route::get('/hello', [App\Http\Controllers\HomeController::class, 'hello']);

    // homestay
    Route::get('/homestay', [App\Http\Controllers\HomestayController::class, 'indexAdmin']);
    Route::get('/homestay/tersedia', [App\Http\Controllers\HomestayController::class, 'tersedia']);
    Route::get('/homestay/dibooking', [App\Http\Controllers\HomestayController::class, 'dibooking']);
    Route::get('/homestay/digunakan', [App\Http\Controllers\HomestayController::class, 'digunakan']);
    Route::post('/homestay/store', [App\Http\Controllers\HomestayController::class, 'store']);
    Route::post('/homestay/update/{id}', [App\Http\Controllers\HomestayController::class, 'update']);
    Route::post('/homestay/destroy/{id}', [App\Http\Controllers\HomestayController::class, 'destroy']);
    Route::post('/homestay/foto/{id}', [App\Http\Controllers\FotoController::class, 'store']);

    // pesanan homestay

    // transaksi

    // akun bank
    Route::get('/akunBank', [App\Http\Controllers\PagesController::class, 'akunBank']);
    Route::post('/bank/store', [App\Http\Controllers\BankController::class, 'store']);
    Route::post('/bank/update/{id}', [App\Http\Controllers\BankController::class, 'update']);
    Route::post('/bank/destroy/{id}', [App\Http\Controllers\BankController::class, 'destroy']);


    // pesanan
    Route::get('/pesanan', [App\Http\Controllers\PagesController::class, 'pesanan']);
    Route::post('/pembayaran/konfirmasi/{id}', [App\Http\Controllers\PesananController::class, 'konfirmasiPembayaran']);

    // profile admin
    Route::get('/profile_admin', [App\Http\Controllers\AdminController::class, 'profile_admin']);
    Route::post('/profile_admin/update', [App\Http\Controllers\AdminController::class, 'update']);

    // transportasi
    Route::post('/transportasi/store', [App\Http\Controllers\TransportasiController::class, 'store']);

});

Route::middleware(['auth', 'user'])->group(function () {

    // homestay
    Route::get('/homestay_user', [App\Http\Controllers\HomestayController::class, 'indexUser']);
    Route::get('/homestay_user/detail/{id}', [App\Http\Controllers\HomestayController::class, 'show']);

    // pesanan
    Route::post('/homestay_user/pesan/{id}', [App\Http\Controllers\PesananController::class, 'store']);
    Route::get('/pesanan_user', [App\Http\Controllers\PesananController::class, 'pesananUser']);
    Route::get('/pesanan_user/detail/{id}', [App\Http\Controllers\PesananController::class, 'pesananDetail']);
    Route::post('/pesanan/ulasan', [App\Http\Controllers\PesananController::class, 'ulasan']);

    // pembayaran
    Route::post('/pembayaran/create/{pengirim}/{tujuan}/{pesanan}', [App\Http\Controllers\PembayaranController::class, 'store']);




});
