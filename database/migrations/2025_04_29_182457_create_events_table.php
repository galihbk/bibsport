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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('skb');
            $table->string('location_event');
            $table->string('maps_event');
            $table->string('location_rpc');
            $table->string('maps_rpc');
            $table->date('start_date_event');
            $table->date('end_date_event');
            $table->date('start_date_rpc');
            $table->date('end_date_rpc');
            $table->string('event_type');
            $table->string('instagram');
            $table->string('poster_url');
            $table->integer('event_validation')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
