<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'birthday',
        'phone_number',
        'client_email',
        'status'
    ];

    public function Appoint(){

        return $this->hasMany(Appoint::class);
    }
}
