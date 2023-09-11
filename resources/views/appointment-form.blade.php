@extends('layout')

@section('content')
    <h1>Agendar Cita en la Barbería</h1>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="client_id">Cliente</label>
            <select id="client_id" name="client_id" class="form-control" required>
                <option value="">Selecciona un cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                @endforeach
            </select>
        </div>

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
            <label>Servicios:</label>
            <br>
            @foreach($services as $service)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}">
                    <label class="form-check-label" for="service_{{ $service->id }}">
                        {{ $service->service_name }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="form-group">
            <label for="drink_id">Bebida</label>
            <select id="drink_id" name="drink_id" class="form-control" required>
                <option value="">Selecciona una bebida</option>
                @foreach ($drinks as $drink)
                    <option value="{{ $drink->id }}">{{ $drink->drink_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="music_id">Música</label>
            <select id="music_id" name="music_id" class="form-control" required>
                <option value="">Selecciona una música</option>
                @foreach ($music as $musicGenre)
                    <option value="{{ $musicGenre->id }}">{{ $musicGenre->music_genre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="appointment_date">Fecha de la Cita</label>
            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
        </div>

        <div class="form-group">
            <label for="selected_time">Hora de la Cita</label>
            <select id="selected_time" name="selected_time" class="form-control" required>
                <option value="">Seleccione una hora</option>
                @for ($hour = 8; $hour < 19; $hour++)
                    @php
                        $formattedHour = sprintf('%02d', $hour) . ':00'; // Formato "hh:00"
                    @endphp
                    <option value="{{ $formattedHour }}">{{ $formattedHour }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
@endsection






