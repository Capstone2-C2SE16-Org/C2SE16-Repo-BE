<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'address',
        'date_of_birth',
        'email',
        'gender',
        'profile_image',
        'phone_number',
        'username',
        'password',
        'is_enable'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
