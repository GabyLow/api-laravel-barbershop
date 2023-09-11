<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Drink;
use App\Models\Music;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        $branches = Branch::all();
        $barbers = Barber::all();
    
        $services = Service::all();
        $drinks = Drink::all();
        $music = Music::all();
        $appointmentToEdit = null;
    
        return view('appointment-form', compact('clients', 'branches', 'barbers', 'services', 'drinks', 'music', 'appointmentToEdit'));
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_date' => 'required|date',
            'selected_time' => 'required',
            'services' => 'required|array|min:1',
            'drink_id' => 'required|exists:drinks,id',
            'music_id' => 'required|exists:music,id',

            dd($request->all()),
        ]);
    
        $selectedServices = Service::whereIn('id', $request->services)->get();
        $totalDuration = $selectedServices->sum('service_duration');
        $totalCost = $selectedServices->sum('service_price');

        // Obtener la hora seleccionada en el formulario
    $selectedTime = $request->selected_time;

    // Calcular el end_time sumando la duración total de los servicios
    $endDateTime = Carbon::parse($request->appointment_date . ' ' . $selectedTime)
        ->addMinutes($totalDuration);
    
        $appointment = new Appointment([
            'client_id' => $request->client_id,
            'branch_id' => $request->branch_id, 
            'barber_id' => $request->barber_id,
            'service_id' => $request->services[0], 
            'drink_id' => $request->drink_id,
            'music_id' => $request->music_id,
            'start_time' => $request->appointment_date . ' ' . $request->selected_time,
            'end_time' => Carbon::parse($request->appointment_date . ' ' . $request->selected_time)->addMinutes($totalDuration),
            'duration' => $totalDuration,
            'total_cost' => $totalCost,
            'status' => 'pending',

        ]);

        

        if ($appointment->save()) {
            $appointment->services()->attach($request->services);
            return redirect()->route('appointment-form')->with('success', 'Cita registrada con éxito');
        } else {
            return redirect()->route('appointment-form')->with('error', 'Error al guardar la cita');
        }

}
}