<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
       
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
       
        return view('clients.create');
    }

    public function store(Request $request)
    {
        
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
       
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        
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
      
        $client->delete();

        return redirect()->route('clients.index');
    }
}

