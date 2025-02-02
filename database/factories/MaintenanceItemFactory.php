<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceItem>
 */
class MaintenanceItemFactory extends Factory
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
            'item_name' => $this->faker->randomElement(['Solenoid', 'Arm','Module Board','Electrical','Controller','Reader']),
            'description' => " ",
        ];
    }
}
