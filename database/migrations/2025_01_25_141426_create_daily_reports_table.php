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
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('technician_id');
            $table->text('activity_details');
            $table->string('status'); // e.g., regular/non-regular
            $table->timestamps();

            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('technician_id')->references('id')->on('technicians');
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
