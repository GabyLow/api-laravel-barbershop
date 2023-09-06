<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $fillable = [
        'service_name',
        'service_description',
        'service_price',
        'service_duration'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}
