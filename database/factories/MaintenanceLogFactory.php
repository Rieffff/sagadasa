<?php

namespace Database\Factories;


use App\Models\MaintenanceLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLog>
 */
class MaintenanceLogFactory extends Factory
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
            'report_detail_id' => \App\Models\DailyActivityDetail::factory(),
            'photos' => $this->faker->randomElement(['before-1.png', 'before-2.png','before-3.png']),
            'description' => $this->faker->randomElement([
                "Inspect landing surface for cracks. Clean cracks thoroughly. Apply sealant according to manufacturer's instructions to prevent water intrusion and further deterioration. Document location and size of sealed cracks.",
                "Remove debris, dirt, oil, and other contaminants from the landing surface using brooms, pressure washers (avoiding excessive pressure), or specialized cleaning solutions. Ensure proper disposal of cleaning materials.",
                "Visually inspect all perimeter lights for proper operation. Check for burned-out bulbs, damaged lenses, and secure connections. Replace faulty bulbs.",
                "Test floodlights to ensure proper illumination of the landing area. Check alignment and intensity. Clean lenses as needed.",
                "Verify that the wind cone is illuminated at night or during low visibility conditions. Check bulb functionality and wiring.",
                "Clean the H marking area. Apply fresh paint according to specifications to ensure clear visibility.",
                "Inspect the wind cone fabric for tears, fraying, or fading. Ensure the frame is in good condition and rotates freely. Replace the wind cone as needed.",
                "Trim trees, bushes, and other vegetation that could obstruct approach and departure paths or signage visibility. Ensure compliance with obstacle clearance requirements.",
                "Inspect obstacle lights (if present) for proper operation. Replace faulty bulbs or fixtures.",
                "Inspect fire extinguishers for proper pressure, damage, and expiration dates. Ensure they are readily accessible.",
                "Check the contents of the first aid kit to ensure it is complete and that all items are within their expiration dates. Replenish supplies as needed.",
                "Calibrate weather sensors according to manufacturer's instructions to ensure accuracy of weather data.",
                "Remove trash, debris, and other foreign objects from the helipad and surrounding areas.",
                "Inspect security gates, fences, and access control systems to ensure they are in good working order."
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
