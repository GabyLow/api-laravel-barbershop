@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Sucursales</h1>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar las sucursales existentes -->
        <table class="table table-striped">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de las sucursales -->
            <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <td>{{ $branch->branch_name }}</td>
                        <td>{{ $branch->branch_address }}</td>
                        <td>{{ $branch->branch_phone }}</td>
                        <td>
                            <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para crear nuevas sucursales -->
        <h2>Nueva Sucursal</h2>
        <form action="{{ route('branches.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="branch_name">Nombre:</label>
                <input type="text" class="form-control" id="branch_name" name="branch_name" required>
            </div>
            <div class="form-group">
                <label for="branch_address">Dirección:</label>
                <input type="text" class="form-control" id="branch_address" name="branch_address" required>
            </div>
            <div class="form-group">
                <label for="branch_phone">Teléfono:</label>
                <input type="text" class="form-control" id="branch_phone" name="branch_phone" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop



