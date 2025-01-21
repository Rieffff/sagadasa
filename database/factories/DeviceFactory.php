<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
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
            'device_name' => $this->faker->word(), // Nama perangkat
            'id_location' => Location::factory(),  // Relasi ke lokasi
        ];
    }
}
