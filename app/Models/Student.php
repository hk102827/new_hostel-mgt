<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
         
        use HasFactory;
       protected $fillable = [
        'name',
        'father_name',
        'gender',
        'cnic',
        'date_of_birth',
        'marital_status',
        'phone',
        'email',
        'nationality',
        'religion',
        'sect',
        'postal_address',
        'address',
        'emergency_contact',
        'station',
        'department',
        'specialization',
        'job_type',
        'admission_date',
        'status',
        'room_id',
        'photo',
    ];
        protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
    ];

        protected $dates = ['admission_date'];

        public function roomAssignment()
        {
            return $this->hasOne(Room_assignment::class)->where('status', 'active');
        }

        public function japaneseAcademy()
        {
            return $this->hasOne(JapaneseAcademyStudent::class);
        }

        public function messManagement()
        {
            return $this->hasOne(Mess_management::class)->where('status', 'active');
        }

        public function fees()
        {
            return $this->hasMany(Fee_management::class);
        }

        public function getPendingAmountAttribute()
        {
             $total = $this->fees->sum('amount');   // maan lo total_amount column hai
            $paid  = $this->fees->sum('paid_amount');
            return max(0, round($total - $paid, 2)); // round to 2 decimals
        }

          public function attendances()
            {
                return $this->morphMany(Attendance::class, 'attendable');
            }
                public function qualifications(): HasMany
                {
                    return $this->hasMany(StudentQualification::class);
                }

    /**
     * Get the experiences for the student.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(StudentExperience::class);
    }

    /**
     * Get the references for the student.
     */
    public function references(): HasMany
    {
        return $this->hasMany(StudentReference::class);
    }

    /**
     * Get the room assigned to the student.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Calculate age from date of birth
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    /**
     * Get total qualifications in years
     */
    public function getTotalQualificationYearsAttribute()
    {
        return $this->qualifications->sum('duration_years');
    }

    /**
     * Get total experience in months
     */
    public function getTotalExperienceMonthsAttribute()
    {
        return $this->experiences->sum('total_period_months');
    }
}

