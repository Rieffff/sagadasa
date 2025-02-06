<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DailyActivityDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\daily_activity_details>
 */
class DailyActivityDetailFactory extends Factory
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
            'device_id' => \App\Models\Device::factory(),
            'activity_description' => $this->faker->randomElement([ 
                "Crack Sealing",
                "Surface Cleaning",
                "Perimeter Light Inspection",
                "Floodlight Testing",
                "Wind Cone Illumination Check",
                "H Marking Repainting",
                "Wind Cone Inspection",
                "Vegetation Trimming",
                "Obstacle Light Inspection",
                "Fire Extinguisher Inspection",
                "First Aid Kit Check",
                "Sensor Calibration",
                "Debris Removal",
                "Security Gate Check"
            ]),
            'report_id' => \App\Models\DailyReport::factory(),
            'status' => $this->faker->randomElement(['regular', 'non-regular','Activity']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
