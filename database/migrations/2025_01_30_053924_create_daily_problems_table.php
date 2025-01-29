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
        Schema::create('daily_problems', function (Blueprint $table) {
            $table->id();
            $table->text('problem');
            $table->text('solution')->nullable();
            $table->foreignId('activity_id')->constrained('daily_activities')->onDelete('cascade');
            $table->string('reported_by'); // Tambahan untuk mencatat siapa yang melaporkan masalah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_problems');
    }
};
