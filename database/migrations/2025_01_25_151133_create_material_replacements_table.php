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
        Schema::create('material_replacements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_log_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity', 10, 2); // e.g., quantity in pcs, liters, meters, etc.
            $table->text('description')->nullable(); // Optional description
            $table->timestamps();

            $table->foreign('maintenance_log_id')->references('id')->on('maintenance_logs')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_replacements');
    }
};
