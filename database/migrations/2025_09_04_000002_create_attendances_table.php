<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('session'); // e.g., Morning, Evening, Class A, etc.
            $table->morphs('attendable'); // attendable_type, attendable_id for student/teacher
            $table->enum('status', ['Present', 'Absent']);
            $table->timestamps();

            $table->unique(['date', 'session', 'attendable_type', 'attendable_id'], 'att_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};