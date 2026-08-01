<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LenderController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('transactions', TransactionController::class);
Route::resource('lenders', LenderController::class)->except(['show']);
Route::resource('loans', LoanController::class)->except(['destroy']);
Route::delete('loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');

Route::post('loans/{loan}/payments', [LoanPaymentController::class, 'store'])->name('loan-payments.store');
Route::delete('loan-payments/{payment}', [LoanPaymentController::class, 'destroy'])->name('loan-payments.destroy');
