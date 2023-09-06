<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class music extends Model
{
    protected $fillable = [
        'music_genre'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'music_id');
    }
}
