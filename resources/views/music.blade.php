@extends('layout')

@section('content')
    <div class="container">
        <h1>Géneros Musicales</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar los géneros musicales existentes -->
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>Género Musical</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas con datos de los géneros musicales -->
            <tbody>
                @foreach($music as $genre)
                    <tr>
                        <td>{{ $genre->music_genre }}</td>
                        <td>
                            <a href="{{ route('music.edit', $genre->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('music.destroy', $genre->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para crear nuevos géneros musicales -->
        <h2>Nuevo Género Musical</h2>
        <form action="{{ route('music.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="music_genre">Género Musical:</label>
                <input type="text" class="form-control" id="music_genre" name="music_genre" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@stop

