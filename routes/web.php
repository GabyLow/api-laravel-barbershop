<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('clients', ClientController::class);
Route::resource('branches', BranchController::class);
Route::resource('barbers', BarberController::class);
Route::resource('services', ServiceController::class);
Route::resource('drinks', DrinkController::class);
Route::resource('music', MusicController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('appointments', AppointmentController::class);




