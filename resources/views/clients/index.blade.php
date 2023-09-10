@extends('layout')

@section('content')
    <h1>Listado de Clientes</h1>
    
    <a class="btn btn-primary" href="{{ route('clients.create') }}" role="button">Crear Cliente</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->client_name }}</td>
                    <td>{{ $client->client_birthday }}</td>
                    <td>{{ $client->client_phone }}</td>
                    <td>{{ $client->client_email }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{ route('appointment-form') }}" role="button">Agendar Cita</a>
@stop

