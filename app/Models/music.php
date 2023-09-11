<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
        'music_genre'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'music_id');
    }
}
