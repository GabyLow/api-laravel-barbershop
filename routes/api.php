<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\AppointmentController;

// Rutas para el controlador de clientes
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::post('/clients', [ClientController::class, 'store']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

// Rutas para el controlador de sucursales
Route::get('/branches', [BranchController::class, 'index']);
Route::get('/branches/{id}', [BranchController::class, 'show']);

// Rutas para el controlador de barberos
Route::get('/barbers', [BarberController::class, 'index']);
Route::get('/barbers/{id}', [BarberController::class, 'show']);

// Rutas para el controlador de servicios
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

// Rutas para el controlador de horarios
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);

// Rutas para el controlador de bebidas
Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drinks/{id}', [DrinkController::class, 'show']);

// Rutas para el controlador de música
Route::get('/music', [MusicController::class, 'index']);
Route::get('/music/{id}', [MusicController::class, 'show']);

// Rutas para el controlador de citas
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
