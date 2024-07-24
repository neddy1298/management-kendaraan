<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\MtGroup;
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
            'mt_group' => MtGroup::factory(),
        ];
    }
}
