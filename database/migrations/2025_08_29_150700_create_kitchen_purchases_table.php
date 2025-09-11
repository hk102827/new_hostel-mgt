<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kitchen_purchases', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('unit', 20)->nullable(); // kg, liter, pack
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->string('notes', 500)->nullable();
            $table->json('extra')->nullable(); // store extra fields

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kitchen_purchases');
    }
};