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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_category_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->enum('discount_type', ['percent', 'fixed']);
            $table->integer('discount_value');
            $table->integer('quota')->default(0);
            $table->date('discount_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
