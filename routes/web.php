<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Middleware\CheckVerified;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard hanya untuk yang sudah login & verified email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup untuk yang sudah login
Route::middleware('auth')->group(function () {
    // Rute untuk profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.detail');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute khusus user yang sudah terverifikasi (CheckVerified)
    Route::middleware(CheckVerified::class)->group(function () {
        Route::get('/event', [EventController::class, 'index'])->name('event');
        Route::get('/add-event', [EventController::class, 'addEvent'])->name('event.add-event');
    });

    // Rute untuk melengkapi akun
    Route::get('/lengkapi-akun', [ProfileController::class, 'completeAccount'])->name('profile.complete');
    Route::post('/lengkapi-akun', [ProfileController::class, 'submitComplete'])->name('profile.submitComplete');
});

require __DIR__ . '/auth.php';
