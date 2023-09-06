<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();
        return response()->json($drinks, 200);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'drink_name' => 'required|string',
            // Agrega otras reglas de validación según necesidades
        ]);

        // Crea una nueva bebida
        $drink = Drink::create($request->all());

        return response()->json($drink, 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'drink_name' => 'required|string',
            // Agrega otras reglas de validación según necesidades
        ]);

        // Busca la bebida por ID
        $drink = Drink::findOrFail($id);

        // Actualiza la bebida con los datos proporcionados
        $drink->update($request->all());

        return response()->json($drink, 200);
    }
}
