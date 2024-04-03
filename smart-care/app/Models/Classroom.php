<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    public function cameras(): HasMany {
        return $this->hasMany(Camera::class);
    }

    public function classroom_type(): BelongsTo {
        return $this->BelongsTo(ClassroomType::class);
    }

    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }
}
