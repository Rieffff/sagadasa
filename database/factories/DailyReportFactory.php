<?php

namespace Database\Factories;

use App\Models\DailyReport;
use App\Models\Contractor;
use App\Models\Company;
use App\Models\Device;
use App\Models\User;
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
            'contractor_id' => Contractor::factory(),
            'company_id' => Company::factory(),
            'device_id' => Device::factory(),
            'technician_id' => User::factory(),
            'activity_details' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['regular', 'non-regular']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
