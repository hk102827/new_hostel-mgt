
<?php

// Migration File: create_fee_managements_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fee_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            
            // Fee breakdown fields
            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->decimal('admission_fee', 10, 2)->default(0);
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->decimal('hostel_fee', 10, 2)->default(0);
            $table->decimal('previous_month_fee', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('other_fee', 10, 2)->default(0);
            
            // Totals and payment info
            $table->decimal('total_amount', 10, 2); // calculated total
            $table->decimal('deposit', 10, 2)->default(0); // amount paid
            $table->decimal('due_balance', 10, 2); // remaining balance
            
            // Date fields
            $table->string('fees_month'); // 2025-01 format
            $table->date('date'); // payment/collection date
            
            // Payment details
            $table->enum('status', ['pending', 'paid', 'partial'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('receipt_number')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fee_managements');
    }
};
