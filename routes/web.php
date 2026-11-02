<?php

use App\Http\Controllers\BillplzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/payments', [BillplzPaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/return',[BillplzPaymentController::class, 'handleReturn'])->name('payments.return');
Route::post('/payments/callback', [BillplzPaymentController::class, 'handleCallback'])->name('payments.callback');

Route::get('/css/app.css', function () {
    return response()->file(resource_path('css/app.css'), [
        'Content-Type' => 'text/css',
    ]);
});


