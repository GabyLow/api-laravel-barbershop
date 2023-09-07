<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clients',[ClientController::class, 'index']);
Route::post('/clients',[ClientController::class, 'store']);
Route::put('/clients/{id}',[ClientController::class, 'update']);
Route::get('/clients/all',[ClientController::class, 'showAll']);

Route::get('/branches',[BranchController::class, 'index']);
Route::post('/branches',[BranchController::class, 'store']);
Route::put('/branches/{id}',[BranchController::class, 'update']);
Route::get('/branches/all',[BranchController::class, 'showAll']);

Route::get('/barbers',[BarberController::class, 'index']);
Route::post('/barbers',[BarberController::class, 'store']);
Route::put('/barbers/{id}',[BarberController::class, 'update']);
Route::get('/barbers/all',[BarberController::class, 'showAll']);

Route::get('/services',[ServiceController::class, 'index']);
Route::post('/services',[ServiceController::class, 'store']);
Route::put('/services/{id}',[ServiceController::class, 'update']);
Route::get('/services/all',[ServiceController::class, 'showAll']);

Route::get('/drinks',[DrinkController::class, 'index']);
Route::post('/drinks',[DrinkController::class, 'store']);
Route::put('/drinks/{id}',[DrinkController::class, 'update']);
Route::get('/drinks/all',[DrinkController::class, 'showAll']);

Route::get('/music',[MusicController::class, 'index']);
Route::post('/music',[MusicController::class, 'store']);
Route::put('/music/{id}',[MusicController::class, 'update']);
Route::get('/music/all',[MusicController::class, 'showAll']);

//schedule 

Route::get('/schedules/available-dates', [ScheduleController::class, 'getAvailableDates']); //Esta ruta (FUNCION) se utiliza para obtener fechas y horas disponibles en función de la sucursal, el servicio y el barbero seleccionados.
Route::post('/schedule/create-appointment', [ScheduleController::class, 'createAppointment']); //createAppointment: Esta ruta se utiliza para crear una nueva cita en la base de datos
Route::get('/schedules', [ScheduleController::class, 'index']); // Mostrar todas las citas
Route::get('/schedules/{id}', [ScheduleController::class, 'show']); // Mostrar una cita específica
Route::put('/schedules/{id}', [ScheduleController::class, 'update']); // Actualizar una cita
Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']); // Eliminar una cita

// Rutas para Appointments
Route::get('/appointments', [AppointmentController::class, 'index']); // Mostrar todas las citas
Route::get('/appointments/{id}', [AppointmentController::class, 'show']); // Mostrar una cita específica
Route::put('/appointments/{id}', [AppointmentController::class, 'update']); // Actualizar una cita
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']); // Eliminar una cita
