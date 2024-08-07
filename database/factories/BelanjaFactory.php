<?php

namespace Database\Factories;

use App\Models\Kendaraan;
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

        $kendaraanId = Kendaraan::pluck('id')->toArray();

        return [
            'kendaraan_id' => $this->faker->randomElement($kendaraanId),
            'belanja_bahan_bakar_minyak' => fake()->numerify('##0000'),
            'belanja_pelumas_mesin' => fake()->numerify('##0000'),
            'belanja_suku_cadang' => fake()->numerify('##0000'),
            'tanggal_belanja' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
