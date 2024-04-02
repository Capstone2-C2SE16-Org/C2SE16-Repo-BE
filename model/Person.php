<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'account_id',
        'name',
        'address',
        'date_of_birth',
        'email',
        'gender',
        'img',
        'phone_number',
    ];
}
