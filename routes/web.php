<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function ()) {
//     return view('auth.login');
// };

// Redirecionar '/' para '/home'
/* Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home'); */

//Rota de fallback (Tratamento de exceção do 404)
/* Route::fallback(function () {
    return redirect()->route('home');
}); */

Route::fallback(function () {
    return redirect()->route('user.register');
});

//Merge Matheus
// Route::get('/register') {
//     return view('auth.register')->name('user.register');
// }

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
