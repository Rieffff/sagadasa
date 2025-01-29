<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MaintenanceLogAfter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLogAfter>
 */
class MaintenanceLogAfterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_log_id' => \App\Models\MaintenanceLog::factory(),
            'photos' => $this->faker->imageUrl(),
            'description' => $this->faker->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
