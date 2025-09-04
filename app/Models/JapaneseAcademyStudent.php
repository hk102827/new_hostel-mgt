<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class JapaneseAcademyStudent extends Model
{
    use HasFactory;

    protected $table = 'japanese_academy_students';

    protected $fillable = [
        'name',
        'father_name',
        'phone',
        'cnic',
        'student_type',   // online / physical
        'hostel_status',  // yes / no
    ];
      public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function messManagement()
    {
        return $this->hasOne(Mess_management::class, 'student_id', 'student_id');
    }

    // Polymorphic relation for attendance
    public function attendances(): MorphMany
    {
        return $this->morphMany(Attendance::class, 'attendable');
    }
}