<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function parents(): HasOne
    {
        return $this->hasOne(Parents::class);
    }

    public function tuitions(): HasOne
    {
        return $this->hasOne(Tuition::class);
    }

    public function student_requests(): HasMany
    {
        return $this->hasMany(StudentRequest::class);
    }

    public function contact_books(): HasOne
    {
        return $this->hasOne(ContactBook::class);
    }
}
