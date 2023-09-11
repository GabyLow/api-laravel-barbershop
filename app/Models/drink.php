<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = [
        'drink_name'
    ];
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'drink_id');
    }
}
