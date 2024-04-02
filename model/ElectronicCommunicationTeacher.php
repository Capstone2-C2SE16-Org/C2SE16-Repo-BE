<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicCommunicationTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'electronic_communication_id',
        'teacher_id',
    ];
}
