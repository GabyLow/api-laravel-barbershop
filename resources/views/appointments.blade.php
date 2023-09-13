@extends('layout')

@section('content')
    <div class="container">
        <h1>Citas</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar las citas existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>Barbero</th>
                    <th>Servicio</th>
                    <th>Bebida</th>
                    <th>Género Musical</th>
                    <th>Fecha y Hora</th>
                    <th>Duración</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de las citas -->
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->client->client_name }}</td>
                        <td>{{ $appointment->branch->branch_name }}</td>
                        <td>{{ $appointment->barber->barber_name }}</td>
                        <td>{{ $appointment->service->service_name }}</td>
                        <td>{{ $appointment->drink->drink_name }}</td>
                        <td>{{ $appointment->music->music_genre }}</td>
                        <td>{{ $appointment->start_time }}</td>
                        <td>{{ $appointment->duration }} minutos</td>
                        <td>${{ $appointment->total_cost }}</td>
                        <td>
                            <a href="{{ route('appointments', $appointment->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('appointments', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<!-- Formulario para crear nuevas citas -->
<h2>Nueva Cita</h2>
<form action="{{ route('appointments') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="client_id">Cliente:</label>
        <select class="form-control" id="client_id" name="client_id" required>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="branch_id">Sucursal:</label>
        <select class="form-control" id="branch_id" name="branch_id" required>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="barber_id">Barbero:</label>
        <select class="form-control" id="barber_id" name="barber_id" required>
            @foreach($barbers as $barber)
                <option value="{{ $barber->id }}">{{ $barber->barber_name }}</option>
            @endforeach
        </select>
    </div>
    <!-- Agrega aquí los campos restantes según tus necesidades -->
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

    </div>
@stop







