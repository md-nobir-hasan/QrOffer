<?php

use App\Http\Controllers\GetOfferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/qr', [GetOfferController::class,'qr']);
Route::get('/qroffer/{ofrcode}', [GetOfferController::class,'infoCollect']);
Route::post('/info/store', [GetOfferController::class,'infoStore'])->name('info.sotre');
Route::get('/otp-check/{user_id}', [GetOfferController::class,'otpcheck'])->name('otpcheck');
Route::post('/otp/match', [GetOfferController::class,'otpMatch'])->name('otp.match');
Route::get('/offer/{user_id}', [GetOfferController::class,'offer'])->name('offer');
