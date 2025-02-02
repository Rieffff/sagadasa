<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MaintenanceLogAfterDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLogAfterDetails>
 */
class MaintenanceLogAfterDetailFactory extends Factory
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
            'maintenance_log_after_id' => \App\Models\MaintenanceLogAfter::factory(),
            'item_name' => $this->faker->randomElement(['Solenoid', 'Arm', 'Module board', 'Electrical', 'Controller', 'Reader']),
            'status' => $this->faker->randomElement(['ok', 'error']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
