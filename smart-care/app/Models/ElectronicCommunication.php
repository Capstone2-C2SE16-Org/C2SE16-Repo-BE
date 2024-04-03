<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElectronicCommunication extends Model
{
    use HasFactory;

    public function parents(): BelongsTo{
        return $this->belongsTo(Student::class);
    }
}
