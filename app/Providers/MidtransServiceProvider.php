<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false); // Ambil dari .env jika ada
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
