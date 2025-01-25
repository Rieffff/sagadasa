<?php

namespace Database\Factories;

use App\Models\DailyReport;
use App\Models\MaintenanceItem;
use App\Models\MaintenanceLog;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLog>
 */
class MaintenanceLogFactory extends Factory
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
            'report_id' => DailyReport::factory(),
            'maintenance_item_id' => MaintenanceItem::factory(),
            'status_before' => $this->faker->sentence(),
            'status_after' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
