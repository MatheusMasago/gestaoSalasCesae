<?php

use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Providers\FortifyServiceProvider;


//Route::get('/login', [UserController::class, 'create'])->name('login');
// Route::get('/user', function (Request $request) {
//     return $request->user();
//})->middleware('auth:sanctum');
// Redirecionar '/' para '/home'
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users/register',[UserController::class, 'create'])->name('user.register');
// Route::get('/login',[UserController::class, 'index'])->name('login');
Route::post('/storeUsers',[UserController::class, 'store'])->name('users.store');

//Rota de fallback (Tratamento de exceção do 404)
 Route::fallback(function () {
    return redirect()->route('home');
});
