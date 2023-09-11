<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches', compact('branches'));
    }

    public function create()
    {
        return view('branches', ['branch' => new Branch()]);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
            
        ]);

        // Crear una nueva sucursal
        Branch::create($request->all());

        return redirect()->route('branches')->with('success', 'Sucursal creada con éxito');
    }

    public function edit($id)
    {
        // Busca la sucursal por ID
        $branch = Branch::findOrFail($id);

        return view('branches', ['branch' => $branch]);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
            
        ]);

      
        $branch = Branch::findOrFail($id);

       
        $branch->update($request->all());

        return redirect()->route('branches')->with('success', 'Sucursal actualizada con éxito');
    }

    public function destroy($id)
    {
        
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches')->with('success', 'Sucursal eliminada con éxito');
    }
}
