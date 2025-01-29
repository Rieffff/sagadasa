<?php

namespace Database\Factories;

use App\Models\MaterialReplacement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialReplacement>
 */
class MaterialReplacementFactory extends Factory
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
            'material_name' => $this->faker->text(),
            'quantity' => $this->faker->randomFloat(2, 1, 10),
            'description' => $this->faker->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
