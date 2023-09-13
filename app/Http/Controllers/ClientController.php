<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::all();

        if ($request->wantsJson()) {
            return response()->json($clients);
        } else {
            return view('clients', compact('clients'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end en formato HTML)
        return view('clients.create');
    }

    public function createJson()
    {
        // Lógica para la creación y respuesta en formato JSON
        $newClient = Client::create([
            'client_name' => 'Nuevo Cliente',
            'client_birthday' => '1990-01-01',
            'client_phone' => '123-456-7890',
            'client_email' => 'nuevo@cliente.com',
            'status' => 'activo',
        ]);

        return response()->json($newClient);
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'client_name' => 'required|string',
            'client_birthday' => 'required|date',
            'client_phone' => 'required|string',
            'client_email' => 'required|email|unique:clients',
            'status' => 'nullable|string',
        ]);

        Client::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Cliente creado con éxito']);
        } else {
            return view('clients');
        }
    }

    public function show(Client $client, Request $request)
    {
        // Lógica para mostrar un cliente específico (puede ser tanto para front-end como para API)
        if ($request->expectsJson()) {
            return response()->json($client);
        } else {
            return view('clients.show', compact('client'));
        }
    }

}


