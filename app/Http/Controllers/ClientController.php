<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        // Muestra la lista de clientes
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        // Muestra el formulario para crear un nuevo cliente
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Almacena un nuevo cliente en la base de datos
        $data = $request->validate([
            'client_name' => 'required|string',
            'client_birthday' => 'required|date',
            'client_phone' => 'required|string',
            'client_email' => 'required|email|unique:clients',
            'status' => 'nullable|string',
        ]);

        Client::create($data);

        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {
        // Muestra los detalles de un cliente específico
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        // Muestra el formulario de edición de un cliente
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        // Actualiza un cliente existente en la base de datos
        $data = $request->validate([
            'client_name' => 'required|string',
            'client_birthday' => 'required|date',
            'client_phone' => 'required|string',
            'client_email' => 'required|email|unique:clients,client_email,' . $client->id,
            'status' => 'nullable|string',
        ]);

        $client->update($data);

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        // Elimina un cliente de la base de datos
        $client->delete();

        return redirect()->route('clients.index');
    }
}

