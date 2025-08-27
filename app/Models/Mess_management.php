<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mess_management extends Model
{
      protected $table = 'mess_managements';
    
    protected $fillable = [
        'student_id', 'plan_type', 'monthly_fee', 'start_date',
        'end_date', 'status', 'dietary_restrictions'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
