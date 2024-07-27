<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\UnitKerja;
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
        $unitKerja = UnitKerja::get()->pluck('id')->toArray();

        return [
            'nomor_registrasi' => Kendaraan::factory(),
            'unit_kerja' =>  $this->faker->randomElement($unitKerja),
        ];
    }
}
