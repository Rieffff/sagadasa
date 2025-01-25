<?php

namespace Database\Factories;

use App\Models\MaintenanceLog;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
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
            'photo_url' => $this->faker->imageUrl(640, 480, 'technics', true, 'Maintenance'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
