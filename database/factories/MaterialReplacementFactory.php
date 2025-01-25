<?php

namespace Database\Factories;

use App\Models\MaintenanceLog;
use App\Models\Material;
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
            'maintenance_log_id' => MaintenanceLog::factory(),
            'material_id' => Material::factory(),
            'quantity' => $this->faker->randomFloat(2, 1, 100), // Random quantity
            'description' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
