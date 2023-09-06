<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
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
        return $this->belongsTo(barber::class, 'barber_id');
    }
}
