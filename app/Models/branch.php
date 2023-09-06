<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_address',
        'branch_phone'
    ];

    public function Appoint(){

        return $this->hasMany(Appoint::class);
    }
}
