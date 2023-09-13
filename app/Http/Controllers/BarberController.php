<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    public function index(Request $request)
    {
        $barbers = Barber::all();

        if ($request->wantsJson()) {
            return response()->json($barbers);
        } else {
            return view('barbers', compact('barbers'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('barbers');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
        ]);

        Barber::create($data);

        return redirect()->route('barbers');
    }

    public function show(Barber $barber)
    {
        // Lógica para mostrar un barbero específico (puede ser tanto para front-end como para API)
        return view('barbers', compact('barber'));
    }

    public function edit(Barber $barber)
    {
        // Lógica para la vista de edición (front-end)
        return view('barbers', compact('barber'));
    }

    public function update(Request $request, Barber $barber)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
        ]);

        $barber->update($data);

        return redirect()->route('barbers');
    }

    public function destroy(Barber $barber)
    {
        // Lógica para eliminar un barbero (back-end)
        $barber->delete();

        return redirect()->route('barbers');
    }
}
