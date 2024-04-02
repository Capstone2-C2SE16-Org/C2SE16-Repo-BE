<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coodinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'person_id',
        'schedule_id',
        'tuition_id',
    ];
}
