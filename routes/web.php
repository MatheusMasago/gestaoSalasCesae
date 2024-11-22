<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Redirecionar '/' para '/home'
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('dashboard',[HomeController::class, 'showDashboard'])->name('user.dashboard');

Route::get('/users/register', [UserController::class, 'create'])->name('user.register');

Route::post('/storeUsers', [UserController::class, 'store'])->name('users.store');

/* Rota de fallback (Tratamento de exceção do 404) */
Route::fallback(function () {
    return redirect()->route('home');
});
