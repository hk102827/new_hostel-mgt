<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('japanese_academy_students', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('student_id')->nullable();  // Foreign key from students table
            $table->string('name');                     // Student name
            $table->string('father_name')->nullable();  // Optional
            $table->string('cnic')->unique();           // CNIC/ID
            $table->string('phone')->nullable();        // Phone no
            $table->enum('student_type', ['online', 'physical']); // Online ya Physical
            $table->boolean('hostel')->default(false);  // Hostel me hai ya nahi
            $table->date('admission_date')->nullable(); // Admission Date
            $table->string('course')->nullable();       // Course/Level
            $table->string('status')->default('active'); // active / inactive / completed
            $table->timestamps();
$table->foreign('student_id')->references('id')->on('students')->onDelete('set null');        });
    }

    public function down(): void
    {
        Schema::dropIfExists('japanese_academy_students');
    }
};
