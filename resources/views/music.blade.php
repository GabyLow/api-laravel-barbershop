@extends('layout')

@section('content')
    <h1>Listado y Gestión de Música</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Género Musical</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($music as $musicGenre)
            <tr>
                <td>{{ $musicGenre->id }}</td>
                <td>{{ $musicGenre->music_genre }}</td>
                <td>
                    <a href="{{ route('music.edit', $musicGenre->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('music.destroy', $musicGenre->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este género musical?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($musicGenreToEdit))
        <h2>Editar Género Musical</h2>
        <form action="{{ route('music.update', $musicGenreToEdit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="music_genre">Género Musical</label>
                <input type="text" id="music_genre" name="music_genre" class="form-control" value="{{ $musicGenreToEdit->music_genre }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else
        <h2>Agregar Nuevo Género Musical</h2>
        <form action="{{ route('music.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="music_genre">Género Musical</label>
                <input type="text" id="music_genre" name="music_genre" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Música</button>
        </form>
    @endif
@stop
