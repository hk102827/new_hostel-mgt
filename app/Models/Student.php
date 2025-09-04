<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
         
        use HasFactory;
        protected $fillable = [
            'name', 'father_name', 'cnic', 'phone', 'email', 
            'address', 'emergency_contact', 'admission_date', 'status'
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
}

