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
        Schema::create('maintenance_log_after_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_log_after_id')->constrained('maintenance_log_afters')->onDelete('cascade');
            $table->string('item_name');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_log_after_details');
    }
};
