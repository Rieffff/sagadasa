<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MaintenanceLogAfter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceLogAfter>
 */
class MaintenanceLogAfterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_log_id' => \App\Models\MaintenanceLog::factory(),
            'photos' => $this->faker->randomElement(['after-1.png', 'after-2.png','after-3.png']),
            'description' => $this->faker->randomElement([
                "Crack sealing completed on the City Hospital Helipad landing surface. Date and time completed: October 27, 2023, 10:00 AM. Technician: John Smith (ID #1234).",
                "Landing surface cleaning completed at City Hospital Helipad. Pressure washing used. Contaminants removed: Dirt, leaves, and minor oil spills. Inspection conducted after cleaning, surface deemed clear. Date and time completed: October 27, 2023, 9:00 AM. Technician: Jane Doe (ID #5678).",
                "Perimeter light inspection completed at City Hospital Helipad. 12 lights inspected. 2 bulbs replaced: LED, 100W, Green. All lights now functioning correctly. Date and time completed: October 27, 2023, 11:00 AM. Technician: John Smith (ID #1234).",
                "Floodlight testing completed at City Hospital Helipad. All floodlights operating within specified intensity and alignment parameters. Lenses cleaned. Date and time completed: October 27, 2023, 11:30 AM. Technician: Jane Doe (ID #5678).",
                "Wind cone illumination checked at City Hospital Helipad. Light functioning correctly. Date and time completed: October 27, 2023, 11:45 AM. Technician: John Smith (ID #1234).",
                "“H” marking repainting completed at City Hospital Helipad. Paint used: Sherwin-Williams A700 White. Marking clearly visible and conforms to standards. Date and time completed: October 26, 2023, 2:00 PM. Technician: Bob Johnson (ID #9012).",
                "Wind cone inspected at City Hospital Helipad. Fabric in good condition. Frame inspected and lubricated. Date and time completed: October 26, 2023, 2:30 PM. Technician: Bob Johnson (ID #9012).",
                "Vegetation trimming completed at City Hospital Helipad. Trees along the approach path trimmed. Obstacles now clear of approach and departure paths. Clearance distances measured and documented. Date and time completed: October 25, 2023, 10:00 AM. Technician: Grounds Crew (Supervisor: Alice Lee).",
                "Obstacle light inspection completed at City Hospital Helipad. 2 lights inspected. All lights functioning correctly. Date and time completed: October 25, 2023, 10:30 AM. Technician: Grounds Crew (Supervisor: Alice Lee).",
                "Fire extinguisher inspection completed at City Hospital Helipad. 3 extinguishers inspected. All extinguishers within pressure and expiration date. Date and time completed: October 27, 2023, 12:00 PM. Technician: Jane Doe (ID #5678).",
                "First aid kit checked at City Hospital Helipad. 2 bandages and antiseptic wipes replenished. All items within expiration dates. Date and time completed: October 27, 2023, 12:15 PM. Technician: John Smith (ID #1234).",
                "Weather sensor calibration completed at City Hospital Helipad. Calibration results: Wind speed sensor calibrated within +/- 1 mph accuracy. System now providing accurate readings. Date and time completed: October 24, 2023, 9:00 AM. Technician: Meteorological Services (Contact: David Miller).",
                "Debris removal completed at City Hospital Helipad. Helipad and surrounding area clear of trash and other foreign objects. Date and time completed: October 27, 2023, 8:00 AM. Technician: Grounds Crew.",
                "Security gate check completed at City Hospital Helipad. All gates and locks functioning correctly. Date and time completed: October 27, 2023, 8:30 AM. Technician: Security Personnel (Contact: Susan Garcia)."
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
