<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicCommunication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'student_id',
        'height',
        'weight',
        'blood_pressure',
        'version_test',
        'total_absences',
        'transcript',
        'comment',
    ];
}
