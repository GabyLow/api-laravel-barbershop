@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Servicios</h1>
</div>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar los servicios existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Duración (min)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de los servicios -->
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->service_description }}</td>
                        <td>${{ $service->service_price }}</td>
                        <td>{{ $service->service_duration }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para crear nuevos servicios -->
        <h2>Nuevo Servicio</h2>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="service_name">Nombre:</label>
                <input type="text" class="form-control" id="service_name" name="service_name" required>
            </div>
            <div class="form-group">
                <label for="service_description">Descripción:</label>
                <textarea class="form-control" id="service_description" name="service_description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="service_price">Precio:</label>
                <input type="number" class="form-control" id="service_price" name="service_price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="service_duration">Duración (min):</label>
                <input type="number" class="form-control" id="service_duration" name="service_duration" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop
