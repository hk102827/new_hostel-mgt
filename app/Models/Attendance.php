<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attendance extends Model
{
    use HasFactory;

      protected $fillable = [
        'date',
        'session',
        'status',
        'student_type',
        'attendable_type',
        'attendable_id',
    ];

    protected $casts = [
        'date' => 'date',
        'student_type' => 'string',
    ];

    public function attendable(): MorphTo
    {
        return $this->morphTo();
    }
}