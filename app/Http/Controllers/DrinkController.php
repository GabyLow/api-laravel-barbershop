<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function index(Request $request)
    {
        $drinks = Drink::all();

        if ($request->wantsJson()) {
            return response()->json($drinks);
        } else {
            return view('drinks', compact('drinks'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('drinks');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'drink_name' => 'required|string',
        ]);

        Drink::create($data);

        return redirect()->route('drinks');
    }

    public function show(Drink $drink)
    {
        // Lógica para mostrar un tipo de bebida específico (puede ser tanto para front-end como para API)
        return view('drinks', compact('drink'));
    }

    public function edit(Drink $drink)
    {
        // Lógica para la vista de edición (front-end)
        return view('drinks', compact('drink'));
    }

    public function update(Request $request, Drink $drink)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'drink_name' => 'required|string',
        ]);

        $drink->update($data);

        return redirect()->route('drinks');
    }

    public function destroy(Drink $drink)
    {
        // Lógica para eliminar un tipo de bebida (back-end)
        $drink->delete();

        return redirect()->route('drinks');
    }
}

