<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'required|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',
            // Agrega otras reglas de validación según necesidades
        ]);

        // Crea un nuevo servicio
        $service = Service::create($request->all());

        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'required|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',
            // Agregar otras reglas de validación según necesidades
        ]);

        // Busca el servicio por ID
        $service = Service::findOrFail($id);

        // Actualiza el servicio con los datos proporcionados
        $service->update($request->all());

        return response()->json($service, 200);
    }
}
