<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MaintenanceLogDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLogDetail>
 */
class MaintenanceLogDetailFactory extends Factory
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
            'maintenance_log_id' => \App\Models\MaintenanceLog::factory(),
            'maintenance_item_id' => \App\Models\MaintenanceItem::factory(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
