<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;

// Redirecionar '/' para '/home'
/* Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home'); */

//Rota de fallback (Tratamento de exceção do 404)
/* Route::fallback(function () {
    return redirect()->route('home');
}); */

//Rota teste calendario
Route::get('/calendar', [ReservationController::class, 'index'])->name('calendar');
Route::post('/calendar', [ReservationController::class, 'store'])->name('store');

/* Route::fallback(function () {
    return redirect()->route('user.register');
});
 */
