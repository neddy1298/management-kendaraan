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
        $mt_group = MtGroup::get()->pluck('id')->toArray();

        return [
            'nomor_registrasi' => Kendaraan::factory(),
            'mt_group' =>  $this->faker->randomElement($mt_group),
        ];
    }
}
