<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        $music = Music::all();

        if ($request->wantsJson()) {
            return response()->json($music);
        } else {
            return view('music', compact('music'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('music');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'music_genre' => 'required|string',
        ]);

        Music::create($data);

        return redirect()->route('music');
    }

    public function show(Music $music)
    {
        // Lógica para mostrar un género musical específico (puede ser tanto para front-end como para API)
        return view('music', compact('music'));
    }

    public function edit(Music $music)
    {
        // Lógica para la vista de edición (front-end)
        return view('music', compact('music'));
    }

    public function update(Request $request, Music $music)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'music_genre' => 'required|string',
        ]);

        $music->update($data);

        return redirect()->route('music');
    }

    public function destroy(Music $music)
    {
        // Lógica para eliminar un género musical (back-end)
        $music->delete();

        return redirect()->route('music');
    }
}

