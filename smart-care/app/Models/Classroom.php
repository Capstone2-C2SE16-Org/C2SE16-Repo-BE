<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = [
        'name',
        'classroom_type_id',
    ];

    public function classroom_type(): BelongsTo
    {
        return $this->belongsTo(ClassroomType::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function cameras(): HasMany
    {
        return $this->hasMany(Camera::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(Manager::class, 'classroom_managers', 'classroom_id', 'manager_id');
    }

    public function learning_schedules(): BelongsToMany
    {
        return $this->belongsToMany(LearningSchedule::class, 'classroom_learning_schedule', 'classroom_id', 'learning_schedule_id');
    }
}
