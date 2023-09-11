@extends('layout')

@section('content')
    <h1>Listado y Gestión de Bebidas</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drinks as $drink)
                <tr>
                    <td>{{ $drink->id }}</td>
                    <td>{{ $drink->drink_name }}</td>
                    <td>
                        <a href="{{ route('drinks.edit', $drink->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('drinks.destroy', $drink->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta bebida?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($drinkToEdit))
        <h2>Editar Bebida</h2>
        <form action="{{ route('drinks.update', $drinkToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="drink_name">Nombre</label>
                <input type="text" id="drink_name" name="drink_name" class="form-control" value="{{ $drinkToEdit->drink_name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Agregar Nueva Bebida</h2>
        <form action="{{ route('drinks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="drink_name">Nombre</label>
                <input type="text" id="drink_name" name="drink_name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Bebida</button>
        </form>
    @endif
@stop
