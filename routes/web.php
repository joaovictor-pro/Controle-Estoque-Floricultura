<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Middleware\VerificarLogin;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(VerificarLogin::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('produtos', ProdutoController::class);
    
    Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');
    Route::get('/movimentacoes/create/{tipo}/{produto_id}', [MovimentacaoController::class, 'create'])->name('movimentacoes.create');
    Route::post('/movimentacoes', [MovimentacaoController::class, 'store'])->name('movimentacoes.store');
});