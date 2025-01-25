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
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('maintenance_item_id');
            $table->text('status_before');
            $table->text('status_after');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('daily_reports')->onDelete('cascade');
            $table->foreign('maintenance_item_id')->references('id')->on('maintenance_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
