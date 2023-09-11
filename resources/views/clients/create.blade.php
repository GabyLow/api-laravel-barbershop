@extends('layout')

@section('content')

<div class="card">
    <div class="card-header">
        Add Client
    </div>
    <div class="card-body">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <label for="client_name" class="form-label">Name</label>
            <input type="text" id="client_name" name="client_name" class="form-control" required>
      
            <label for="client_birthday" class="form-label">Birthday</label>
            <input type="date" id="client_birthday" name="client_birthday" class="form-control" required>
            
            <label for="client_phone" class="form-label">Phone</label>
            <input type="text" id="client_phone" name="client_phone" class="form-control" required>
          
            <label for="client_email" class="form-label">Email</label>
            <input type="email" id="client_email" name="client_email" class="form-control" required>
          
            <button type="submit" class="btn btn-primary">Add Client</button>
       </form>
    </div>
</div>

@stop