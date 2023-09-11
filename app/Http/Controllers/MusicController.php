<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function index()
    {
        $music = Music::all();
        return view('music', compact('music'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'music_genre' => 'required|string',
            // Agrega otras reglas de validación según necesidades
        ]);

        // Crea un nuevo género musical
        $music = Music::create($request->all());

        return response()->json($music, 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'music_genre' => 'required|string',
            // Agrega otras reglas de validación según necesidades
        ]);

        // Busca el género musical por ID
        $music = Music::findOrFail($id);

        // Actualiza el género musical con los datos proporcionados
        $music->update($request->all());

        return response()->json($music, 200);
    }
}
