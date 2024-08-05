<?php

namespace Database\Factories;

use App\Models\Belanja;
use App\Models\Maintenance;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanTahunan>
 */
class LaporanTahunanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paguAnggarans = PaguAnggaran::get()->pluck('id')->toArray();
        return [
            'pagu_anggaran_id' => $this->faker->randomElement($paguAnggarans),
            'tahun' => date('Y'),
        ];
    }
}
