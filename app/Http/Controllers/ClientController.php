<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = client::all();
        return response()->json($clients, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'client_birthday' => 'required|date',
            'client_email' => 'required|email|unique:clients,client_email',
        ]);

        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'client_birthday' => 'required|date',
            'client_email' => 'required|email|unique:clients,client_email,' . $client->id,
        ]);

        $client->update($request->all());

        return response()->json($client, 200);
    }
}
