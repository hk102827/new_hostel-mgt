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
        'attendable_type',
        'attendable_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function attendable(): MorphTo
    {
        return $this->morphTo();
    }
}