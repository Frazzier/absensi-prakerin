<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'start',
        'end',
        'sunday_in',
        'sunday_out',
        'monday_in',
        'monday_out',
        'tuesday_in',
        'tuesday_out',
        'wednesday_in',
        'wednesday_out',
        'thursday_in',
        'thursday_out',
        'friday_in',
        'friday_out',
        'saturday_in',
        'saturday_out',
    ];
}
