<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

// Redirecionar '/' para '/home'
/* Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home'); */

//Rota de fallback (Tratamento de exceção do 404)
/* Route::fallback(function () {
    return redirect()->route('home');
}); */

//Rota teste calendario
Route::get('/calendar', [CalendarController::class, 'events'])->name('calendar');


/* Route::fallback(function () {
    return redirect()->route('user.register');
});
 */
