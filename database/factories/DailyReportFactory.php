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
            'work_reason' => $this->faker->sentence(),
            'location' => $this->faker->randomElement(['HELIPAD', 'GATE ACCESS','TRIPOD']),
            'detail_activity' => $this->faker->randomElement(['MAINTENANCE', 'BUILDING']),
            'po' => "Yes",
            'contractor_id' => \App\Models\Contractor::factory(),
            'company_id' => \App\Models\Company::factory(),
            'approved_by' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
