<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::all();

        if ($request->wantsJson()) {
            return response()->json($schedules);
        } else {
            return view('schedules', compact('schedules'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('schedules');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
            'schedule_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'nullable|boolean',
        ]);

        Schedule::create($data);

        return redirect()->route('schedules');
    }

    public function show(Schedule $schedule)
    {
        // Lógica para mostrar un horario específico (puede ser tanto para front-end como para API)
        return view('schedules', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        // Lógica para la vista de edición (front-end)
        return view('schedules', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
            'schedule_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'nullable|boolean',
        ]);

        $schedule->update($data);

        return redirect()->route('schedules');
    }

    public function destroy(Schedule $schedule)
    {
        // Lógica para eliminar un horario (back-end)
        $schedule->delete();

        return redirect()->route('schedules');
    }
}

