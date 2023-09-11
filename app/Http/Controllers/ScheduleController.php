<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Barber;
use App\Models\Branch;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
{
    $schedules = Schedule::all();
    $branches = Branch::all(); // Obtener todas las sucursales, ajusta esto según tu modelo Branch
    $barbers = Barber::all(); // Obtener todos los barberos, ajusta esto según tu modelo Barber

    return view('schedules', compact('schedules', 'branches', 'barbers'));
}
    
    
    
    // Acción para mostrar fechas y horas disponibles
    public function getAvailableDates(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
        ]);

        // Obtener fechas y turnos disponibles en función de la sucursal y el barbero seleccionados
        $branchId = $request->input('branch_id');
        $barberId = $request->input('barber_id');

        $availableDatesAndTimes = $this->calculateAvailableDatesAndTimes($branchId, $barberId);

        return response()->json(['available_dates_and_times' => $availableDatesAndTimes], 200);
    }

    private function calculateAvailableDatesAndTimes($branchId, $barberId)
    {
        // Obtener la fecha actual
        $currentDate = Carbon::now();

        // Inicializar un arreglo para almacenar las fechas y turnos disponibles
        $availableDatesAndTimes = [];

        // Iterar a través de los próximos días (por ejemplo, 7 días)
        for ($i = 0; $i < 7; $i++) {
            // Calcular la fecha para el día actual más $i días
            $date = $currentDate->addDays($i)->format('Y-m-d');

            // Aquí debes implementar la lógica para obtener los turnos disponibles para esta fecha
            // Puedes consultar tu base de datos y obtener los turnos disponibles para la sucursal y el barbero seleccionados

            // Ejemplo: Obtener los turnos disponibles para la fecha actual
            $availableTimes = $this->getAvailableTimesForDate($branchId, $barberId, $date);

            // Agregar la fecha y los turnos disponibles al arreglo
            $availableDatesAndTimes[$date] = $availableTimes;
        }

        return $availableDatesAndTimes;
    }

    private function getAvailableTimesForDate($branchId, $barberId, $date)
    {

        return [];
    }
}
