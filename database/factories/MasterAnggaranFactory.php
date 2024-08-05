<?php

namespace Database\Factories;

use App\Models\LaporanTahunan;
use App\Models\PaguAnggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterAnggaran>
 */
class MasterAnggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paguAnggarans = PaguAnggaran::get()->pluck('id')->toArray();
        // $laporanTahunans = LaporanTahunan::get()->pluck('id')->toArray();
        return [
            'pagu_anggaran_id' => $this->faker->randomElement($paguAnggarans),
            // 'laporan_tahunan_id' => $this->faker->randomElement($laporanTahunans),
            'kode_rekening' => $this->faker->unique()->numerify('#.#.#.#'),
            'nama_rekening' => $this->faker->unique()->word(),
            'anggaran' => fake()->numerify('##00000000'),
        ];
    }
}
