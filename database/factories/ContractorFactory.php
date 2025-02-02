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
            'contractor_name' => "CV. SAGADASA OPTIMA SOLUSI",
            'logo' => "sagadasa.png",
            'address' => "Balikpapan Kalimantan Timur ",
            'contact_information' => $this->faker->phoneNumber,
        ];
    }
}
