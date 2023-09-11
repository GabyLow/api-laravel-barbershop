@extends('layout')

@section('content')
    <h1>Listado y Gestión de Servicios</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Duración (minutos)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->service_description }}</td>
                    <td>${{ $service->service_price }}</td>
                    <td>{{ $service->service_duration }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($serviceToEdit))
        <h2>Editar Servicio</h2>
        <form action="{{ route('services.update', $serviceToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="service_name">Nombre</label>
                <input type="text" id="service_name" name="service_name" class="form-control" value="{{ $serviceToEdit->service_name }}" required>
            </div>

            <div class="form-group">
                <label for="service_description">Descripción</label>
                <textarea id="service_description" name="service_description" class="form-control" required>{{ $serviceToEdit->service_description }}</textarea>
            </div>

            <div class="form-group">
                <label for="service_price">Precio</label>
                <input type="number" id="service_price" name="service_price" class="form-control" step="0.01" value="{{ $serviceToEdit->service_price }}" required>
            </div>

            <div class="form-group">
                <label for="service_duration">Duración (minutos)</label>
                <input type="number" id="service_duration" name="service_duration" class="form-control" value="{{ $serviceToEdit->service_duration }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Crear Nuevo Servicio</h2>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="service_name">Nombre</label>
                <input type="text" id="service_name" name="service_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="service_description">Descripción</label>
                <textarea id="service_description" name="service_description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="service_price">Precio</label>
                <input type="number" id="service_price" name="service_price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="service_duration">Duración (minutos)</label>
                <input type="number" id="service_duration" name="service_duration" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Servicio</button>
        </form>
    @endif
@stop
