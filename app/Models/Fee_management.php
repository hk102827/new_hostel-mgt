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

    protected $dates = ['due_date', 'paid_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
