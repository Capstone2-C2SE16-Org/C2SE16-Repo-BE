<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LearningSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date', 
        'morning', 
        'noon', 
        'afternoon'
    ];

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class);
    }
}
