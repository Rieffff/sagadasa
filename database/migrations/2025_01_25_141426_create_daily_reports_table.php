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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->time('work_start');
            $table->integer('work_break')->nullable();
            $table->time('work_stop');
            $table->text('service_data')->nullable();
            $table->string('work_reason')->nullable();
            $table->text('location')->nullable();
            $table->string('detail_activity')->nullable();
            $table->enum('po',['Yes','No'])->default('Yes')->nullable();
            $table->string('approved_by')->nullable(); // Tambahan untuk approval
            $table->foreignId('contractor_id')->constrained('contractors')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};
