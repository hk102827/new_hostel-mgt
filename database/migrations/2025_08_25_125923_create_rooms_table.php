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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->enum('room_type', ['single', 'double', 'triple', 'quad']);
            $table->integer('capacity');
            $table->integer('occupied')->default(0);
            $table->decimal('rent', 8, 2);
            $table->enum('status', ['available', 'full', 'maintenance'])->default('available');
            $table->text('facilities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
