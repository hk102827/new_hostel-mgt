<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('name');
            $table->string('father_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('cnic')->unique();
            $table->date('date_of_birth');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->string('sect')->nullable();
            $table->text('postal_address');
            $table->text('address'); // Current address
            $table->string('emergency_contact');
            $table->string('photo')->nullable(); // Student image path

            
            // Station/Department
            $table->string('station')->nullable(); // Islamabad/Lahore/Karachi
            $table->string('department')->nullable();
            $table->string('specialization')->nullable();
            $table->enum('job_type', ['permanent', 'contract', 'temporary'])->default('permanent');
            
            // Admission Details
            $table->date('admission_date');
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
            
            // Room Assignment
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};