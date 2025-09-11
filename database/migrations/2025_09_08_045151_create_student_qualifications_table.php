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
        Schema::create('student_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->enum('degree_type', ['SSC', 'HSSC', 'Bachelor', 'Masters', 'MS/M.Phil', 'Ph.D']);
            $table->decimal('duration_years', 3, 1); // e.g., 2.5 years
            $table->string('specialization')->nullable();
            $table->year('passing_year');
            $table->string('cgpa_grade');
            $table->string('institute_board_university');
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_qualifications');
    }
};