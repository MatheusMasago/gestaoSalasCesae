<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::middleware('verified')->get('/home', function () {
    return view('home.index');
})->name('home');

Route::middleware('auth')->group(function () {
    // Definindo a rota para o índice de users
    Route::resource('users', UserController::class);
    // Definindo a rota para o índice de reservas
    Route::resource('reservations', ReservationController::class);
    Route::put('cancel-reservation/{id}', [ReservationController::class, 'cancel'])->name('cancel.reservation');
    Route::put('confirm-reservation/{id}', [ReservationController::class, 'confirm'])->name('confirm.reservation');
    // Definindo a rota para o índice de rooms
    Route::resource('rooms', RoomController::class);
    // Definindo a rota para o índice de locals
    Route::resource('locals', LocalController::class);
    // Definindo a rota para o índice de courses
    Route::resource('courses', CourseController::class);
    // Definindo a rota para o stats de courses
    Route::get('stats', [ReservationController::class, 'stats'])->name('stats');
});

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware('auth');

Route::get('/addUser', [UserController::class, 'create'])->name('addUser');

Route::post('/addUser', [UserController::class, 'store']);

Route::get('/notifications', [VerificationController::class, 'showNotifications'])->name('notifications');

// Remova a verificação manual e confie no middleware:
Route::middleware('auth')->get('/notifications/{notificationId}/read', [VerificationController::class, 'markAsRead'])->name('notifications.read');

Route::fallback(function () {
    return redirect()->route('login');
});
