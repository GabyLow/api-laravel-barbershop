<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_id', 
        'appointment_date', 
        'barber_id', 
        'service_id', 
        'drink_id', 
        'music_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function drink()
    {
        return $this->belongsTo(Drink::class, 'drink_id');
    }

    public function music()
    {
        return $this->belongsTo(Music::class, 'music_id');
    }
}
