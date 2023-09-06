<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class drink extends Model
{
    protected $fillable = [
        'drink_name'
    ];
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'drink_id');
    }
}
