@extends('layout')

@section('content')
    <div class="container">
        <h1>Bebidas</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar las bebidas existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de las bebidas -->
            <tbody>
                @foreach($drinks as $drink)
                    <tr>
                        <td>{{ $drink->drink_name }}</td>
                        <td>
                            <a href="{{ route('drinks.edit', $drink->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('drinks.destroy', $drink->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para crear nuevas bebidas -->
        <h2>Nueva Bebida</h2>
        <form action="{{ route('drinks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="drink_name">Nombre:</label>
                <input type="text" class="form-control" id="drink_name" name="drink_name" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop

