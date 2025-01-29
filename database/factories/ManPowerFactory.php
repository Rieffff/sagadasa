<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ManPower;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManPower>
 */
class ManPowerFactory extends Factory
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
            'name' => $this->faker->name(),
            'position' => $this->faker->jobTitle(),
            'notes' => $this->faker->text(),
            'report_id' => \App\Models\DailyReport::factory(),
            'user_id' => $this->faker->numberBetween(1, 4),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
