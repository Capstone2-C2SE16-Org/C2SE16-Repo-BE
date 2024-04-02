<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'status',
      'date_of_payment',
      'student_id',
    ];
}
