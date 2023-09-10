<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'index']);
Route::resource('clients', ClientController::class);

Route::get('/appointment-form', function () {
    return view('appointment-form');
})->name('appointment-form');

Route::get('/appointment-form', [AppointmentController::class, 'create'])->name('appointment-form');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');




