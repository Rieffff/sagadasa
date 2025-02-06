<?php

namespace Database\Factories;

use App\Models\DailyReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyReport>
 */
class DailyReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'report_date' => $this->faker->date(),
            'work_start' => $this->faker->time(),
            'work_break' => "1",
            'work_stop' => $this->faker->time(),
            'work_reason' => $this->faker->randomElement([
                'The landing surface has developed cracks and potholes, posing a hazard to aircraft.',
                'The lighting system is experiencing intermittent failures, reducing visibility during nighttime operations.',
                'The wind cone is damaged and no longer provides accurate wind direction information.',
                'Recent FAA inspections have identified deficiencies in the perimeter lighting system that must be addressed to maintain certification.',
                'New local regulations require upgrades to the fire suppression system.'
            ]),
            'service_data' => "This document outlines the essential service data ...",
            'location' => $this->faker->randomElement(['HELIPAD', 'GATE ACCESS','TRIPOD']),
            'detail_activity' => $this->faker->randomElement(['Maintenance','Rebuilding']),
            'po' => "Yes",
            'contractor_id' => \App\Models\Contractor::factory(),
            'company_id' => \App\Models\Company::factory(),
            'approved_by' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
