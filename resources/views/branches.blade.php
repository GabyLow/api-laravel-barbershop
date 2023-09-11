@extends('layout')

@section('content')
    <h1>Listado y Gestión de Sucursales</h1>

    <a class="btn btn-primary mb-3" href="{{ route('branches.create') }}" role="button">Crear Sucursal</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
                <tr>
                    <td>{{ $branch->id }}</td>
                    <td>{{ $branch->branch_name }}</td>
                    <td>{{ $branch->branch_address }}</td>
                    <td>{{ $branch->branch_phone }}</td>
                    <td>
                        <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta sucursal?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($branchToEdit))
        <h2>Editar Sucursal</h2>
        <form action="{{ route('branches.update', $branchToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="branch_name">Nombre</label>
                <input type="text" id="branch_name" name="branch_name" class="form-control" value="{{ $branchToEdit->branch_name }}" required>
            </div>

            <div class="form-group">
                <label for="branch_address">Dirección</label>
                <input type="text" id="branch_address" name="branch_address" class="form-control" value="{{ $branchToEdit->branch_address }}" required>
            </div>

            <div class="form-group">
                <label for="branch_phone">Teléfono</label>
                <input type="text" id="branch_phone" name="branch_phone" class="form-control" value="{{ $branchToEdit->branch_phone }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Crear Nueva Sucursal</h2>
        <form action="{{ route('branches.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="branch_name">Nombre</label>
                <input type="text" id="branch_name" name="branch_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="branch_address">Dirección</label>
                <input type="text" id="branch_address" name="branch_address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="branch_phone">Teléfono</label>
                <input type="text" id="branch_phone" name="branch_phone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Sucursal</button>
        </form>
    @endif
@stop
