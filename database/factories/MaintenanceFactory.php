<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_registrasi' => Kendaraan::factory(),
            'bahan_bakar_minyak' => fake()->randomElement(['2', '3', '5', 'lainnya']),
            'pelumas_mesin' => fake()->randomElement(['1', '2', 'lainnya']),
            'suku_cadang' => $this->faker->optional()->word(),
        ];
    }
}
