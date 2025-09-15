<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee_management extends Model
{
        protected $table = 'fee_managements';
    
  protected $fillable = [
        'student_id',
        'monthly_fee',
        'admission_fee', 
        'registration_fee',
        'hostel_fee',
        'previous_month_fee',
        'discount',
        'other_fee',
        'total_amount',
        'deposit',
        'due_balance',
        'fees_month',
        'date',
        'status',
        'payment_method',
        'receipt_number',
        'notes'
    ];

    protected $casts = [
        'monthly_fee' => 'decimal:2',
        'admission_fee' => 'decimal:2',
        'registration_fee' => 'decimal:2',
        'hostel_fee' => 'decimal:2',
        'previous_month_fee' => 'decimal:2',
        'discount' => 'decimal:2',
        'other_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'deposit' => 'decimal:2',
        'due_balance' => 'decimal:2',
        'date' => 'date'
    ];

 
    
    // Helper method to get fee breakdown as array
    public function getFeeBreakdown()
    {
        return [
            'Monthly Fee' => $this->monthly_fee,
            'Admission Fee' => $this->admission_fee,
            'Registration Fee' => $this->registration_fee,
            'Hostel Fee' => $this->hostel_fee,
            'Previous Month Fee' => $this->previous_month_fee,
            'Discount' => $this->discount,
            'Other Fee' => $this->other_fee,
        ];
    }
    
    // Helper method to check if fully paid
    public function isFullyPaid()
    {
        return $this->status === 'paid' || $this->due_balance <= 0;
    }
    

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
