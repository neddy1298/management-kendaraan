<?php

namespace Database\Factories;

use App\Models\Belanja;
use App\Models\LaporanTahunan;
use App\Models\MasterAnggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanBulanan>
 */
class LaporanBulananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $laporanTahunans = LaporanTahunan::get()->pluck('id')->toArray();

        return [
            'laporan_tahunan_id' => $this->faker->randomElement($laporanTahunans),
            'bulan' => $this->faker->unique()->date('m'),
        ];
    }
}
