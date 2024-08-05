<?php

namespace Database\Factories;

use App\Models\Maintenance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Belanja>
 */
class BelanjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure there is at least one Maintenance record
        if (Maintenance::count() == 0) {
            Maintenance::factory()->create();
        }

        $maintenanceIds = Maintenance::pluck('id')->toArray();

        return [
            'maintenance_id' => $this->faker->randomElement($maintenanceIds),
            'belanja_bahan_bakar_minyak' => fake()->numerify('##0000'),
            'belanja_pelumas_mesin' => fake()->numerify('##0000'),
            'belanja_suku_cadang' => fake()->numerify('##0000'),
            'tanggal_belanja' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
