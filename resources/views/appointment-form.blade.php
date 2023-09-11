@extends('layout')

@section('content')
    <h1>Reservar una Cita</h1>

    <!-- Formulario para crear o actualizar citas -->
    @if(isset($appointmentToEdit))
        <form action="{{ route('appointments.update', $appointmentToEdit->id) }}" method="POST">
            @method('PUT')
    @else
        <form action="{{ route('appointments.store') }}" method="POST">
    @endif
        @csrf

        <!-- Paso 1: Información del Cliente (Seleccionar Cliente Existente) -->
        <h2>Paso 1: Seleccionar Cliente</h2>
        <div class="form-group">
            <label for="client_id">Seleccionar Cliente Existente</label>
            <select id="client_id" name="client_id" class="form-control" required>
                <option value="">Seleccione un cliente existente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Paso 2: Selección de Sucursal y Paso 3: Selección de Barbero -->
        <h2>Paso 2: Selección de Sucursal y Paso 3: Selección de Barbero</h2>
        <div class="form-group">
            <label for="branch_id">Sucursal</label>
            <select id="branch_id" name="branch_id" class="form-control" required>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="barber_id">Barbero</label>
            <select id="barber_id" name="barber_id" class="form-control" required>
                @foreach ($barbers as $barber)
                    <option value="{{ $barber->id }}">{{ $barber->barber_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Paso 3: Fecha y Hora -->
        <div class="form-group">
            <label for="appointment_date">Fecha de la Cita</label>
            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="selected_time">Hora de la Cita</label>
            <select id="selected_time" name="selected_time" class="form-control" required>
                <option value="">Seleccione una hora</option>
                <!-- Ejemplo de opciones en formato de 24 horas -->
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
            </select>
        </div>

        <!-- Paso 4: Servicios -->
        <h2>Paso 4: Servicios</h2>
        <div class="form-group">
            @foreach ($services as $service)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}">
                    <label class="form-check-label" for="service_{{ $service->id }}">{{ $service->service_name }}</label>
                </div>
            @endforeach
        </div>

        <!-- Paso 5: Bebidas y Música -->
        <div class="form-group">
            <label for="drink_id">Bebida</label>
            <select id="drink_id" name="drink_id" class="form-control" required>
                <option value="">Seleccione una bebida</option>
                @foreach ($drinks as $drink)
                    <option value="{{ $drink->id }}">{{ $drink->drink_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="music_id">Música</label>
            <select id="music_id" name="music_id" class="form-control" required>
                <option value="">Seleccione una música</option>
                @foreach ($music as $musicGenre)
                    <option value="{{ $musicGenre->id }}">{{ $musicGenre->music_genre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para crear o actualizar cita -->
        <button type="submit" class="btn btn-primary">
            @if(isset($appointmentToEdit))
                Actualizar Cita
            @else
                Reservar Cita
            @endif
        </button>
    </form>

    <!-- Lista de citas existentes -->
    <h2>Lista de Citas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <!-- Agrega encabezados para otras columnas de citas aquí -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <!-- Agrega columnas para otras propiedades de citas aquí -->
                    <td>
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
