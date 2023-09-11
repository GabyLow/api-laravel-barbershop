<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\MusicController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('clients', [ClientController::class, 'index']);
Route::resource('clients', ClientController::class);


Route::get('/appointment-form', [AppointmentController::class, 'create'])->name('appointment-form');



Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


Route::resource('branches', BranchController::class);


Route::resource('barbers', BarberController::class);


Route::resource('services', ServiceController::class);


Route::resource('schedules', ScheduleController::class);


Route::resource('drinks', DrinkController::class);


Route::resource('music', MusicController::class);




