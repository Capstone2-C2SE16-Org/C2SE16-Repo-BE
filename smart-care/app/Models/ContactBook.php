<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactBook extends Model
{
    use HasFactory;    

    protected $fillable = [
        'height', 
        'weight', 
        'blood_group',
        'blood_pressure', 
        'vision_test', 
        'allergies',
        'total_absences',
        'good_behavior_certificates',
        'comment', 
        'student_id' 
    ];

    protected $casts = [
        'good_behavior_certificates' => 'array' 
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function contact_book_managers(): HasMany
    {
        return $this->hasMany(ContactBookManager::class);
    }
}
