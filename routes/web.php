<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\SavingsGoalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExternalApiController;
// Rota para registro de usuário
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Rota para login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');;
Route::post('/login', [UserController::class, 'login']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Rota para criação de carteira
Route::get('/wallet/create', [WalletController::class, 'create'])->name('wallet.create');
Route::post('/wallet', [WalletController::class, 'store'])->name('wallet.store');

// Rota para transferência de dinheiro
Route::get('/wallet/transfer', [WalletController::class, 'showTransferForm'])->name('wallet.transfer');
Route::post('/wallet/transfer', [WalletController::class, 'transfer']);

Route::get('/getExchangeRate', [ExternalApiController::class, 'getExchangeRate'])->name('externalApi.getExchangeRate');
Route::get('/getEconomyData', [ExternalApiController::class, 'getEconomyData'])->name('externalApi.getEconomyData');

// Rotas referentes as metas criadas pelo usuário
Route::get('/savings-goals/create', [SavingsGoalController::class, 'create'])->name('savings-goals.create');
Route::post('/savings-goals/create', [SavingsGoalController::class, 'store']);
Route::get('/savings-goals', [SavingsGoalController::class, 'index'])->name('savings-goals.index');
Route::get('/savings-goals/{savingsGoal}/edit', [SavingsGoalController::class, 'edit'])->name('savings-goals.edit');
Route::put('/savings-goals/{savingsGoal}', [SavingsGoalController::class, 'update'])->name('savings-goals.update');
Route::delete('/savings-goals/{savingsGoal}', [SavingsGoalController::class, 'destroy'])->name('savings-goals.destroy');

//Rota referente ao log de transações
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
