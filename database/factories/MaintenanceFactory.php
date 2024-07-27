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
        $unit_kerja = UnitKerja::get()->pluck('id')->toArray();

        return [
            'nomor_registrasi' => Kendaraan::factory(),
            'mt_group' =>  $this->faker->randomElement($unit_kerja),
        ];
    }
}
