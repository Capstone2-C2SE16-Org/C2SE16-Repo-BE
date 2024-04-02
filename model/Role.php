<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Eloquent Roles
 * @property int id 
 * @property string name
*/
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];
}