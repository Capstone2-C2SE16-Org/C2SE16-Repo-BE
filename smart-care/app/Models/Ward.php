<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'name',
        'gso_id',
        'published',
        'district_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function managers(): HasMany
    {
        return $this->hasMany(Manager::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
