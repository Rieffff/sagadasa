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
            $table->foreignId('maintenance_log_after_id')->constrained('maintenance_log_afters')->onDelete('cascade');
            $table->string('material_name'); // Menggunakan string, bukan foreign key
            $table->decimal('quantity', 8, 2);
            $table->text('description')->nullable();
            $table->timestamps();
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
