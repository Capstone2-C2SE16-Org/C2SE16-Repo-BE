<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassroomType extends Model
{
    use HasFactory;

    public function classrooms(): HasMany {
        return $this->HasMany(Classroom::class);
    }
}
