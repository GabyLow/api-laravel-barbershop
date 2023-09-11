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
       
        $request->validate([
            'music_genre' => 'required|string',
           
        ]);

       
        $music = Music::create($request->all());

        return response()->json($music, 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'music_genre' => 'required|string',
          
        ]);

        
        $music = Music::findOrFail($id);

       
        $music->update($request->all());

        return response()->json($music, 200);
    }
}
