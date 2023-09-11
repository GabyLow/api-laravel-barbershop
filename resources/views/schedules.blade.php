@extends('layout')

@section('content')
    <h1>Listado y Gestión de Horarios</h1>

    <a class="btn btn-primary mb-3" href="{{ route('schedules.create') }}" role="button">Crear Horario</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sucursal</th>
                <th>Barbero</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->id }}</td>
                    <td>{{ $schedule->branch->branch_name }}</td>
                    <td>{{ $schedule->barber->barber_name }}</td>
                    <td>{{ $schedule->schedule_date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este horario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($scheduleToEdit))
        <h2>Editar Horario</h2>
        <form action="{{ route('schedules.update', $scheduleToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="branch_id">Sucursal</label>
                <select id="branch_id" name="branch_id" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branch->id == $scheduleToEdit->branch_id ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="barber_id">Barbero</label>
                <select id="barber_id" name="barber_id" class="form-control" required>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}" {{ $barber->id == $scheduleToEdit->barber_id ? 'selected' : '' }}>
                            {{ $barber->barber_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="schedule_date">Fecha</label>
                <input type="date" id="schedule_date" name="schedule_date" class="form-control" value="{{ $scheduleToEdit->schedule_date }}" required>
            </div>

            <div class="form-group">
                <label for="start_time">Hora de Inicio</label>
                <input type="time" id="start_time" name="start_time" class="form-control" value="{{ $scheduleToEdit->start_time }}" required>
            </div>

            <div class="form-group">
                <label for="end_time">Hora de Finalización</label>
                <input type="time" id="end_time" name="end_time" class="form-control" value="{{ $scheduleToEdit->end_time }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Crear Nuevo Horario</h2>
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
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

            <div class="form-group">
                <label for="schedule_date">Fecha</label>
                <input type="date" id="schedule_date" name="schedule_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_time">Hora de Inicio</label>
                <input type="time" id="start_time" name="start_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_time">Hora de Finalización</label>
                <input type="time" id="end_time" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Horario</button>
        </form>
    @endif
@stop
