<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return response()->json($branches, 200);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
            // Agregar otras reglas de validación según necesidades
        ]);

        // Crear una nueva sucursal
        $branch = Branch::create($request->all());

        return response()->json($branch, 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
            // Agregar otras reglas de validación según necesidades
        ]);

        // Busca la sucursal por ID
        $branch = Branch::findOrFail($id);

        // Actualiza la sucursal con los datos proporcionados
        $branch->update($request->all());

        return response()->json($branch, 200); // 200 OK
    }
}
