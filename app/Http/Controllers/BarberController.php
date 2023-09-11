<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Branch;


class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        $branches = Branch::all(); 
        return view('barbers', compact('barbers', 'branches'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
            
        ]);
    
        // Crear un nuevo barbero
        $barber = Barber::create($request->all());
    
        // Redirige a la vista de listado de barberos
        return redirect()->route('barbers.index');
    }
    
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'barber_name' => 'required|string',
      
        ]);
    
        // Buscar el barbero por ID
        $barber = Barber::findOrFail($id);
    
        // Actualizar el barbero con los datos proporcionados
        $barber->update($request->all());
    
        // Redirigir a la vista de listado de barberos
        return redirect()->route('barbers.index');
    }
    
}
