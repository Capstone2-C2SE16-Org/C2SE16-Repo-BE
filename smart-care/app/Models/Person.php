<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }

    public function teachers(): HasMany {
        return $this->hasMany(Teacher::class);
    }

    public function coodinators(): HasMany {
        return $this->hasMany(Coodinator::class);
    }

}
