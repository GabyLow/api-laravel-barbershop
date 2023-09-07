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
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('barber_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('drink_id');
            $table->unsignedBigInteger('music_id');
            $table->dateTime('start_time'); // Hora de inicio de la cita
            $table->dateTime('end_time');   // Hora de finalización de la cita
            $table->integer('duration');    // Duración total de la cita en minutos
            $table->float('total_cost');    // Costo total de la cita
            $table->timestamps();
            
            // Definir las relaciones y restricciones de clave externa
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('branch_id')->references('id')->on('branches');
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
