<?php

// StudentQualification Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'degree_type',
        'duration_years',
        'specialization',
        'passing_year',
        'cgpa_grade',
        'institute_board_university',
        'country'
    ];

    protected $casts = [
        'duration_years' => 'decimal:1',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}