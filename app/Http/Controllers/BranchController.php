<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::all();

        if ($request->wantsJson()) {
            return response()->json($branches);
        } else {
            return view('branches', compact('branches'));
        }
    }

    public function create()
    {
        // Lógica para la vista de creación (front-end)
        return view('branches');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
        ]);

        Branch::create($data);

        return redirect()->route('branches');
    }

    public function show(Branch $branch)
    {
        // Lógica para mostrar una sucursal específica (puede ser tanto para front-end como para API)
        return view('branches', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        // Lógica para la vista de edición (front-end)
        return view('branches', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        // Lógica para actualizar datos en la base de datos (back-end)
        $data = $request->validate([
            'branch_name' => 'required|string',
            'branch_address' => 'required|string',
            'branch_phone' => 'required|string',
        ]);

        $branch->update($data);

        return redirect()->route('branches');
    }

    public function destroy(Branch $branch)
    {
        // Lógica para eliminar una sucursal (back-end)
        $branch->delete();

        return redirect()->route('branches');
    }
}
