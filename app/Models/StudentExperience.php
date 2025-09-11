<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'institution_organization',
        'position_job_title',
        'from_date',
        'to_date',
        'total_period_months'
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Calculate total period in months automatically
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($experience) {
            if ($experience->from_date && $experience->to_date) {
                $from = \Carbon\Carbon::parse($experience->from_date);
                $to = \Carbon\Carbon::parse($experience->to_date);
                $experience->total_period_months = $from->diffInMonths($to);
            }
        });
    }
}
