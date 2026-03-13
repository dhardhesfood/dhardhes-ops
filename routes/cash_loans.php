<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashLoanController;

Route::get('/cash-loans', [CashLoanController::class, 'index']);
Route::post('/cash-loans', [CashLoanController::class, 'store']);
Route::post('/cash-loans/pay/{id}', [CashLoanController::class, 'pay']);