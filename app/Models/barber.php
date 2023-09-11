<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'branch_id',
        'barber_name'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'barber_id');
    }
}
