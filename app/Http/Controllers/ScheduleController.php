<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Client;
use App\Models\Service;
use App\Models\Barber;
use App\Models\Branch;
use App\Models\Drink;
use App\Models\Music;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    // Acción para mostrar fechas y horas disponibles
    public function getAvailableDates(Request $request)
    {
        // Lógica para obtener fechas y horas disponibles en función de la sucursal, el servicio y el barbero seleccionados
        // Puedes consultar la base de datos y retornar los datos necesarios en el formato adecuado
    }

    // Acción para registrar una nueva cita
    public function createAppointment(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'client_birthday' => 'required|date',
            'client_email' => 'required|email',
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'drink_id' => 'required|exists:drinks,id',
            'music_id' => 'required|exists:music,id',
        ]);

        // Crear una nueva cita en la base de datos
        $appointment = new Schedule([
            'branch_id' => $request->branch_id,
            'barber_id' => $request->barber_id,
            'schedule_date' => $request->schedule_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'client_birthday' => $request->client_birthday,
            'client_email' => $request->client_email,
            'service_id' => $request->service_id,
            'drink_id' => $request->drink_id,
            'music_id' => $request->music_id,
        ]);

        $appointment->save();

        // Calcular el costo total de los servicios (puedes hacerlo aquí)
        $totalCost = 0; // Debes calcular esto

        // Envía un correo de confirmación al cliente
       // Mail::to($request->client_email)->send(new AppointmentConfirmation($appointment, $totalCost));

        // Devuelve una respuesta de éxito
        return response()->json(['message' => 'Cita registrada con éxito'], 201);
    }

    // Otras acciones relacionadas con la gestión de citas, notificaciones, etc.

}
