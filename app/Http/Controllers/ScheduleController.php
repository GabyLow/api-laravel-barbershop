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
        $branches = Branch::all();
        $barbers = Barber::all();

        return view('schedules', compact('schedules', 'branches', 'barbers'));
    }




    public function getAvailableDates(Request $request)
    {

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_id' => 'required|exists:barbers,id',
        ]);


        $branchId = $request->input('branch_id');
        $barberId = $request->input('barber_id');

        $availableDatesAndTimes = $this->calculateAvailableDatesAndTimes($branchId, $barberId);

        return response()->json(['available_dates_and_times' => $availableDatesAndTimes], 200);
    }

    private function calculateAvailableDatesAndTimes($branchId, $barberId)
    {

        $currentDate = Carbon::now();


        $availableDatesAndTimes = [];


        for ($i = 0; $i < 7; $i++) {

            $date = $currentDate->addDays($i)->format('Y-m-d');


            $availableTimes = $this->getAvailableTimesForDate($branchId, $barberId, $date);


            $availableDatesAndTimes[$date] = $availableTimes;
        }

        return $availableDatesAndTimes;
    }

    private function getAvailableTimesForDate($branchId, $barberId, $date)
    {

        return [];
    }
}
