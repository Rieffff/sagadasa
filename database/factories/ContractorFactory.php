<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contractor>
 */
class ContractorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Contractor::class;
    public function definition(): array
    {
        return [
            'contractor_name' => $this->faker->company,
            'logo' => "sagadasa.png",
            'address' => $this->faker->address,
            'contact_information' => $this->faker->phoneNumber,
        ];
    }
}
