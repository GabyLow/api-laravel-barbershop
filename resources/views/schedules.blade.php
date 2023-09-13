@extends('layout')

@section('content')
    <div class="container">
        <h1>Horarios</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar los horarios existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Barbería</th>
                    <th>Barbero</th>
                    <th>Fecha</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Disponible</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de los horarios -->
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->branch->branch_name }}</td>
                        <td>{{ $schedule->barber->barber_name }}</td>
                        <td>{{ $schedule->schedule_date }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>{{ $schedule->is_available ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<!-- Formulario para crear nuevos horarios -->
<h2>Nuevo Horario</h2>
<form action="{{ route('schedules.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="branch_id">ID de la Sucursal:</label>
        <input type="text" class="form-control" id="branch_id" name="branch_id" required>
    </div>
    <div class="form-group">
        <label for="day_of_week">Día de la Semana:</label>
        <input type="text" class="form-control" id="day_of_week" name="day_of_week" required>
    </div>
    <div class="form-group">
        <label for="start_time">Hora de Inicio:</label>
        <input type="text" class="form-control" id="start_time" name="start_time" required>
    </div>
    <div class="form-group">
        <label for="end_time">Hora de Fin:</label>
        <input type="text" class="form-control" id="end_time" name="end_time" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
</div>
@stop

