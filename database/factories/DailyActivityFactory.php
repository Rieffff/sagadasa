<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DailyActivity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyActivities>
 */
class DailyActivityFactory extends Factory
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
            'activity' => $this->faker->randomElement(['Maintenance', 'Building','Survey']),
            'note' => $this->faker->paragraph(),
            'user_name' => fake()->name(),
            'report_id' => \App\Models\DailyReport::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
