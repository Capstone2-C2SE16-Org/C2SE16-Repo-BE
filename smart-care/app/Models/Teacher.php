<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    public function person(): BelongsTo {
        return $this->belongsTo(Person::class);
    }

    public function announcements(): HasMany {
        return $this->hasMany(Announcement::class);
    }

    public function student_requests(): HasMany {
        return $this->hasMany(StudentRequest::class);
    }
    
}
