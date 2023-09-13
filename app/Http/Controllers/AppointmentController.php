<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Drink;
use App\Models\Music;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::all();

        if ($request->wantsJson()) {
            return response()->json($appointments);
        } else {
            return view('appointments', compact('appointments'));
        }
    }

    public function create(Request $request)
    {
        $clients = Client::all();
        $branches = Branch::all();
        $barbers = Barber::all();
        $services = Service::all();
        $drinks = Drink::all();
        $music = Music::all();
        $appointmentToEdit = null;

        if ($request->wantsJson()) {
            return response()->json([
                'clients' => $clients,
                'branches' => $branches,
                'barbers' => $barbers,
                'services' => $services,
                'drinks' => $drinks,
                'music' => $music,
                'appointmentToEdit' => $appointmentToEdit,
            ]);
        } else {
            return view('appointments', compact('clients', 'branches', 'barbers', 'services', 'drinks', 'music', 'appointmentToEdit'));
        }
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
        ]);

        $selectedServices = Service::whereIn('id', $request->services)->get();
        $totalDuration = $selectedServices->sum('service_duration');
        $totalCost = $selectedServices->sum('service_price');

        $selectedTime = $request->selected_time;

        $endDateTime = Carbon::parse($request->appointment_date . ' ' . $selectedTime)->addMinutes($totalDuration);

        $appointment = new Appointment([
            'client_id' => $request->client_id,
            'branch_id' => $request->branch_id,
            'barber_id' => $request->barber_id,
            'service_id' => $request->services[0],
            'drink_id' => $request->drink_id,
            'music_id' => $request->music_id,
            'start_time' => $request->appointment_date . ' ' . $request->selected_time,
            'end_time' => $endDateTime,
            'duration' => $totalDuration,
            'total_cost' => $totalCost,
            'status' => 'pending',
        ]);

        if ($appointment->save()) {
            $appointment->services()->attach($request->services);
            return redirect()->route('appointments')->with('success', 'Cita registrada con éxito');
        } else {
            return redirect()->route('appointments')->with('error', 'Error al guardar la cita');
        }
    }

    public function show(Request $request, Appointment $appointment)
    {
        if ($request->wantsJson()) {
            return response()->json(['data' => $appointment]);
        } else {
            return view('appointments', compact('appointment'));
        }
    }
    

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $branches = Branch::all();
        $barbers = Barber::all();
        $services = Service::all();
        $drinks = Drink::all();
        $music = Music::all();
        $appointmentToEdit = $appointment;

        return view('appointments', compact('clients', 'branches', 'barbers', 'services', 'drinks', 'music', 'appointmentToEdit'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Lógica para actualizar la cita (back-end)
    }

    public function destroy(Appointment $appointment)
    {
        // Lógica para eliminar la cita (back-end)
    }
}
