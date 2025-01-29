<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DailyProblem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyProblems>
 */
class DailyProblemFactory extends Factory
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
            'problem' => $this->faker->sentence(),
            'solution' => $this->faker->sentence(),
            'activity_id' => \App\Models\DailyActivity::factory(),
            'reported_by' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
