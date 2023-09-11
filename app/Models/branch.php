<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'branch_name',
        'branch_address',
        'branch_phone'
    ];

    public function barbers()
    {
        return $this->hasMany(Barber::class, 'id_branch');
    }
}
