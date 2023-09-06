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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('barber_id');
            $table->unsignedBigInteger('service_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('drink_id');
            $table->unsignedBigInteger('music_id');
            $table->string('status')->default('pending'); // we can use: 'pending', 'confirmed', 'cancelled', etc.
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('barber_id')->references('id')->on('barbers');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('drink_id')->references('id')->on('drinks');
            $table->foreign('music_id')->references('id')->on('music');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
