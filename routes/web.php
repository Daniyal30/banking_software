<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LenderController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/lenders', LenderController::class);
    Route::resource('/loan', LoanController::class);
    Route::resource('/loanPayment', LoanPaymentController::class);
    Route::get('/loanPayment/get-lender-loan/{lender}', [LoanPaymentController::class,'getLenderLoan'])->name('loanPayment.getLenderLoan');
    Route::resource('/transaction', TransactionController::class);
});
