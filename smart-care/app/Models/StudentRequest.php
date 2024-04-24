<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentRequest extends Model
{
    use HasFactory;

    protected $table = 'student_requests';

    protected $fillable = [
        'reason',  
        'other_reason',   
        'leave_date',       
        'return_date',    
        'status',         
        'request_date',
        'student_id',
        'manager_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}
