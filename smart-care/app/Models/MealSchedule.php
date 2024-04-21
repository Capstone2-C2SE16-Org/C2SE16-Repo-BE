<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'morning', 
        'noon', 
        'afternoon'
    ];

}
