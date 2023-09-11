<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'branch_id',
        'barber_id',
        'schedule_date',
        'start_time',
        'end_time'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }
}
