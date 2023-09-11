@extends('layout')

@section('content')
    <h1>Listado y Gestión de Barberos</h1>

    <a class="btn btn-primary mb-3" href="{{ route('barbers.create') }}" role="button">Crear Barbero</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Sucursal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barbers as $barber)
                <tr>
                    <td>{{ $barber->id }}</td>
                    <td>{{ $barber->barber_name }}</td>
                    <td>{{ $barber->branch->branch_name }}</td>
                    <td>
                        <a href="{{ route('barbers.edit', $barber->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este barbero?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($barberToEdit))
        <h2>Editar Barbero</h2>
        <form action="{{ route('barbers.update', $barberToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="barber_name">Nombre</label>
                <input type="text" id="barber_name" name="barber_name" class="form-control" value="{{ $barberToEdit->barber_name }}" required>
            </div>

            <div class="form-group">
                <label for="branch_id">Sucursal</label>
                <select id="branch_id" name="branch_id" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $barberToEdit->branch_id == $branch->id ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Crear Nuevo Barbero</h2>
        <form action="{{ route('barbers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="barber_name">Nombre</label>
                <input type="text" id="barber_name" name="barber_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="branch_id">Sucursal</label>
                <select id="branch_id" name="branch_id" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Barbero</button>
        </form>
    @endif
@stop
