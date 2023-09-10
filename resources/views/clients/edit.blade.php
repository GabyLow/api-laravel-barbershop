@extends('layout')

@section('content')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Utiliza el método PUT para actualizar el cliente -->

        <div class="form-group">
            <label for="client_name">Nombre</label>
            <input type="text" id="client_name" name="client_name" class="form-control" value="{{ $client->client_name }}" required>
        </div>

        <div class="form-group">
            <label for="client_birthday">Fecha de Nacimiento</label>
            <input type="date" id="client_birthday" name="client_birthday" class="form-control" value="{{ $client->client_birthday }}" required>
        </div>

        <div class="form-group">
            <label for="client_phone">Teléfono</label>
            <input type="text" id="client_phone" name="client_phone" class="form-control" value="{{ $client->client_phone }}" required>
        </div>

        <div class="form-group">
            <label for="client_email">Email</label>
            <input type="email" id="client_email" name="client_email" class="form-control" value="{{ $client->client_email }}" required>
        </div>

        <div class="form-group">
            <label for="status">Estado</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ $client->status }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
@endsection
