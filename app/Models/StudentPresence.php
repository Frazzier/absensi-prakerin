<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'schedule_time_in',
        'schedule_time_out',
        'in',
        'out',
        'coordinate_in',
        'coordinate_out',
        'is_free',
    ];
}
