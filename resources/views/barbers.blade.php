@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Barberos</h1>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar los barberos existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de los barberos -->
            <tbody>
                @foreach($barbers as $barber)
                    <tr>
                        <td>{{ $barber->barber_name }}</td>
                        <td>{{ $barber->branch->branch_name }}</td>
                        <td>
                            <a href="{{ route('barbers.edit', $barber->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<!-- Formulario para crear nuevos barberos -->
<h2>Nuevo Barbero</h2>
<form action="{{ route('barbers.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="barber_name">Nombre:</label>
        <input type="text" class="form-control" id="barber_name" name="barber_name" required>
    </div>
    <div class="form-group">
        <label for="branch_id">ID de la Sucursal:</label>
        <input type="number" class="form-control" id="branch_id" name="branch_id" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@stop

