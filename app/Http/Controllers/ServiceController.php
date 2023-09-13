<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();

        if ($request->wantsJson()) {
            return response()->json($services);
        } else {
            return view('services', compact('services'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('services');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'nullable|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',
        ]);

        Service::create($data);

        return redirect()->route('services');
    }

    public function show(Service $service)
    {
        // Lógica para mostrar un servicio específico (puede ser tanto para front-end como para API)
        return view('services', compact('service'));
    }

    public function edit(Service $service)
    {
        // Lógica para la vista de edición (front-end)
        return view('services', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'nullable|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',
        ]);

        $service->update($data);

        return redirect()->route('services');
    }

    public function destroy(Service $service)
    {
        // Lógica para eliminar un servicio (back-end)
        $service->delete();

        return redirect()->route('services');
    }
}

