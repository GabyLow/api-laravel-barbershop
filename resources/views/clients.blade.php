@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Clientes</h1>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar los clientes existentes -->
        <table class="table table-striped">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de los clientes -->
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->client_birthday }}</td>
                        <td>{{ $client->client_phone }}</td>
                        <td>{{ $client->client_email }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para crear nuevos clientes -->
        <h2>Nuevo Cliente</h2>
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="client_name">Nombre:</label>
                <input type="text" class="form-control" id="client_name" name="client_name" required>
            </div>
            <div class="form-group">
                <label for="client_birthday">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="client_birthday" name="client_birthday" required>
            </div>
            <div class="form-group">
                <label for="client_phone">Teléfono:</label>
                <input type="text" class="form-control" id="client_phone" name="client_phone" required>
            </div>
            <div class="form-group">
                <label for="client_email">Email:</label>
                <input type="email" class="form-control" id="client_email" name="client_email" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop


