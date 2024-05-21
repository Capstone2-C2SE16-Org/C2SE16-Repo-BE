<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'gso_id',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
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
