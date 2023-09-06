<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        return response()->json($barbers, 200);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
            // Agregar otras reglas de validación según tus necesidades
        ]);

        // Crear un nuevo barbero
        $barber = Barber::create($request->all());

        return response()->json($barber, 201); // 201 Created
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
            // Agregar otras reglas de validación según tus necesidades
        ]);

        // Buscar el barbero por ID
        $barber = Barber::findOrFail($id);

        // Actualizar el barbero con los datos proporcionados
        $barber->update($request->all());

        return response()->json($barber, 200); // 200 OK
    }
}
