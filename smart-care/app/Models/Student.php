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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'is_enable',
        'classroom_id',
        'parents'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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
