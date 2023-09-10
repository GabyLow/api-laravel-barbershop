<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Drink;
use App\Models\Music;
use App\Models\Client;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Vista para crear una nueva cita
    public function create()
    {
        $branches = Branch::all();
        $barbers = Barber::all();
        $services = Service::all();
        $drinks = Drink::all();
        $music = Music::all();
        $clients = Client::all(); // Agrega esta línea para obtener la lista de clientes
    
        return view('appointment-form', compact('branches', 'barbers', 'services', 'drinks', 'music', 'clients'));
    }

    // Procesar la solicitud de reserva de cita
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'client_birthday' => 'required|date',
            'client_email' => 'required|email',
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_date' => 'required|date',
            'selected_time' => 'required',
            'services' => 'required|array|min:1',
            'drink_id' => 'required|exists:drinks,id',
            'music_id' => 'required|exists:music,id',
        ]);

        // Buscar o crear un cliente basado en el correo electrónico proporcionado
        $client = Client::firstOrCreate(
            ['client_email' => $request->client_email],
            [
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'client_birthday' => $request->client_birthday,
            ]
        );

 // Calcular la duración total y el costo total de la cita
 $selectedServices = Service::whereIn('id', $request->services)->get();
 $totalDuration = $selectedServices->sum('duration');
 $totalCost = $selectedServices->sum('total_cost');

 // Crear una nueva cita en la base de datos
 $appointment = new Appointment([
     'client_id' => $client->id,
     'start_time' => $request->appointment_date . ' ' . $request->selected_time, // Hora de inicio
     'end_time' => Carbon::parse($request->appointment_date . ' ' . $request->selected_time)->addMinutes($totalDuration), // Hora de finalización calculada a partir de la duración
     'duration' => $totalDuration, // Duración total calculada
     'total_cost' => $totalCost, // Costo total calculado
     'branch_id' => $request->branch_id,
     'barber_id' => $request->barber_id,
     'drink_id' => $request->drink_id,
     'music_id' => $request->music_id,
     'status' => 'pending',
 ]);

 $appointment->save();

 if (!$appointment->save()) {
    // Manejo del error, como registrar el mensaje de error
    dd('Error al guardar la cita: ' . $appointment->getError());
}


        // Asociar servicios seleccionados con la cita
        $appointment->services()->attach($request->services);

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('appointment-form')->with('success', 'Cita registrada con éxito');
    }
}

