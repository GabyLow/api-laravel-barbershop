<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = [
        'client_name',
        'client_birthday',
        'client_phone',
        'client_email',
        'status'
    ];

    public function Appoint(){

        return $this->hasMany(Appointment::class, 'client_id');
    }
}
