<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckVerified;
use App\Mail\InvoicePaidMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event-list', [HomeController::class, 'eventList'])->name('home.event-list');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/events/run', [HomeController::class, 'run'])->name('home.run');
Route::get('/events/register/{id}', [HomeController::class, 'register'])->name('home.event-register');
Route::post('/events/register/store', [HomeController::class, 'registerStore'])->name('home.event-register-store');
Route::get('/events/payment/payment-status', [HomeController::class, 'paymentStatus'])->name('home.payment-status');
Route::get('/events/payment/check-payment-status/{orderId}', [HomeController::class, 'checkPaymentStatus'])->name('home.check-payment-status');
Route::post('/cek-voucher', [HomeController::class, 'cekVoucher'])->name('home.cek-voucher');
Route::get('/events/slug/{slug}', [HomeController::class, 'eventDetail'])->name('home.event-detail');
Route::post('/contact/send', [HomeController::class, 'send'])->name('home.send');
Route::get('/event-success-payment', [HomeController::class, 'successPage'])->name('event.success.payment');
// Route::get('/test-send-invoice/{order_id}', function ($order_id) {
//     $order = Order::with('ticket.eventCategory')->where('order_id', $order_id)->first();

//     if (!$order) {
//         return "Order dengan ID $order_id tidak ditemukan.";
//     }

//     try {
//         Mail::to($order->email)->send(new InvoicePaidMail($order));
//         return "Email invoice berhasil dikirim ke " . $order->email;
//     } catch (\Exception $e) {
//         \Log::error('Gagal mengirim email invoice.', [
//             'order_id' => $order_id,
//             'message' => $e->getMessage(),
//             'trace' => $e->getTraceAsString(),
//         ]);

//         return "Gagal mengirim email: " . $e->getMessage();
//     }
// });

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
        Route::post('/event/category-store', [EventController::class, 'categoryStore'])->name('event.category-store');
        Route::get('/event/get-peserta-terdaftar', [EventController::class, 'getPesertaTerdaftar'])->name('event.get-peserta-terdaftar');
        Route::get('/event/get-peserta-tidak-terdaftar', [EventController::class, 'getPesertaTidakTerdaftar'])->name('event.get-peserta-tidak-terdaftar');
        Route::post('/event/ticket-store', [EventController::class, 'ticketStore'])->name('event.ticket-store');
        Route::post('/event/voucher-store', [EventController::class, 'voucherStore'])->name('event.voucher-store');
        Route::get('/event-detail/{id}', [EventController::class, 'eventDetail'])->name('event.detail');
        Route::get('/event/search', [EventController::class, 'search'])->name('event.search');
        Route::get('/event/categories', [EventController::class, 'categories'])->name('event.categories');
        Route::post('/event', [EventController::class, 'index'])->name('event');
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

require __DIR__ . '/auth.php';
