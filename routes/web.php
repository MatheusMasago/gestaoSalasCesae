<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Providers\FortifyServiceProvider;

// Redirecionar '/' para '/home'
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/home', [HomeController::class, 'index'])->name('go_to_home');

//Rota de fallback (Tratamento de exceção do 404)
 Route::fallback(function () {
    return redirect()->route('home');
});

 Route::fallback(function () {
    return redirect()->route('user.register');
});
Route::get('/login', [HomeController::class, 'index'])->name('blade_login');
Route::post('/login', [FortifyServiceProvider::class, 'boot'])->name('rota.login');
