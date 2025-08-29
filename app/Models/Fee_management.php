<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee_management extends Model
{
        protected $table = 'fee_managements';
    
    protected $fillable = [
        'student_id', 'fee_type', 'amount', 'due_date', 'paid_date',
        'status', 'paid_amount', 'payment_method', 'receipt_number', 'notes'
    ];

    // Ensure Carbon instances for dates (reliable in newer Laravel versions)
    protected $casts = [
        'fee_type' => 'array',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];
    

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
