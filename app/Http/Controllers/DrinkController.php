<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();
        return view('drinks', compact('drinks'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'drink_name' => 'required|string',
            
        ]);

      
        $drink = Drink::create($request->all());

        return response()->json($drink, 201);
    }

    public function update(Request $request, $id)
    {
      
        $request->validate([
            'drink_name' => 'required|string',
           
        ]);

       
        $drink = Drink::findOrFail($id);

    
        $drink->update($request->all());

        return response()->json($drink, 200);
    }
}
