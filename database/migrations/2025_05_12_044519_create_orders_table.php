<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');

            // Data pendaftar
            $table->string('bib', 10)->nullable();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->enum('ukuran_jersey', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'XXXXL', 'XXXXXL']);
            $table->enum('jenis_identitas', ['KTP', 'SIM', 'PASPORT', 'KARTU PELAJAR']);
            $table->string('nomor_identitas', 50);
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->text('alamat');
            $table->string('email');
            $table->string('no_wa', 20);

            // Kontak darurat
            $table->string('nama_kontak_darurat', 100);
            $table->string('no_kontak_darurat', 20);
            $table->string('hubungan_kontak', 50);

            // Optional
            $table->string('voucher')->nullable();

            // Informasi pembayaran Midtrans
            $table->string('order_id')->unique()->nullable(); // kode unik ke Midtrans
            $table->string('snap_token')->nullable();
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed', 'challenge'])->default('pending');
            $table->string('metode_pembayaran')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->integer('jumlah_bayar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
