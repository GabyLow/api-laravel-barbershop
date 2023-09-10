<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $fillable = [
        'branch_name',
        'branch_address',
        'branch_phone'
    ];

    public function barbers()
    {
        return $this->hasMany(barber::class, 'id_branch');
    }
}
