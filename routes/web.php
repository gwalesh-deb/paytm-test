<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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
    return view('welcome');
});

Route::get('payment', [PaymentController::class,'index']);
Route::post('indipay/response', [PaymentController::class,'indipayresponse']);
Route::get('paytm', [PaymentController::class,'paytmindex']);

Route::get('event', [PaymentController::class,'bookEvent']);
Route::post('payment',[PaymentController::class,'eventOrderGen'])->name('payment');
Route::post('payment/status',[PaymentController::class,'paymentCallbackstatus'])->name('paymentCallbackstatus');
