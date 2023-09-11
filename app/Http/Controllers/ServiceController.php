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

        $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'required|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',

        ]);


        $service = Service::create($request->all());

        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'required|string',
            'service_price' => 'required|numeric',
            'service_duration' => 'required|integer',

        ]);


        $service = Service::findOrFail($id);


        $service->update($request->all());

        return response()->json($service, 200);
    }
}
