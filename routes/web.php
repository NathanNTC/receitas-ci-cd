<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

// Redireciona a raiz (/) para o formulário de login
Route::redirect('/', '/login');

// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas Protegidas (Apenas para usuários logados)
Route::middleware('auth')->group(function () {

    Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');

    Route::get('/receitas/create', [ReceitaController::class, 'create'])->name('receitas.create');

    Route::post('/receitas', [ReceitaController::class, 'store'])->name('receitas.store');

    Route::get('/receitas/{id}/edit', [ReceitaController::class, 'edit'])->name('receitas.edit');

    Route::put('/receitas/{id}', [ReceitaController::class, 'update'])->name('receitas.update');

    Route::delete('/receitas/{id}', [ReceitaController::class, 'destroy'])->name('receitas.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
