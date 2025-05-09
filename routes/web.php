<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckVerified;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event-list', [HomeController::class, 'eventList'])->name('home.event-list');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact/send', [HomeController::class, 'send'])->name('home.send');

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.detail');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dokumen/{filename}', [ProfileController::class, 'downloadDokumen'])
        ->name('dokumen.download');
    // Rute khusus user yang sudah terverifikasi (CheckVerified)
    Route::middleware(CheckVerified::class)->group(function () {
        Route::get('/event', [EventController::class, 'index'])->name('event');
        Route::get('/add-event', [EventController::class, 'addEvent'])->name('event.add-event');
        Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
        Route::post('/event', [EventController::class, 'index'])->name('event');
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

require __DIR__ . '/auth.php';
