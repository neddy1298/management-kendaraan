<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\LaporanBulanan;
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

        $laporanBulanans = LaporanBulanan::get()->pluck('id')->toArray();

        return [
            'kendaraan_id' => Kendaraan::factory(),
            'laporan_bulanan_id' => $this->faker->randomElement($laporanBulanans),
            'tanggal_maintenance' => now(),
        ];
    }
}
