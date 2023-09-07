<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Models\Barber;
use App\Models\Branch;
use App\Models\Drink;
use App\Models\Music;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // Acción para registrar una nueva cita
    public function createAppointment(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string',
            'num_tel' => 'required|string',
            'b_date' => 'required|date',
            'email' => 'required|email',
            'branch' => 'required|exists:branches,id',
            'barber' => 'required|exists:barbers,id',
            'schedule_date' => 'required|date',
            'selectedTime' => 'required',
            'services' => 'required|array|min:1', // Al menos un servicio debe estar seleccionado
            'drink' => 'required|exists:drinks,id',
            'music' => 'required|exists:music,id',
        ]);

        // Crear una nueva cita en la base de datos
        $appointment = new Appointment([
            'client_id' => 1, // Reemplaza con la lógica para obtener el ID del cliente
            'appointment_date' => $request->schedule_date . ' ' . $request->selectedTime,
            'barber_id' => $request->barber,
            'service_id' => $request->services,
            'drink_id' => $request->drink,
            'music_id' => $request->music,
            'status' => 'pending', // Puede cambiar el estado según necesidades
        ]);

        $appointment->save();

        // Calcular el costo total de los servicios (puedes hacerlo aquí)
        $totalCost = 0; // Debes calcular esto

        // Envía un correo de confirmación al cliente
        // Aquí se agregar la lógica para enviar el correo

        // Devuelve una respuesta de éxito
        return response()->json(['message' => 'Cita registrada con éxito'], 201);
    }

    // Otras acciones relacionadas con la gestión de citas, notificaciones, etc.

}
