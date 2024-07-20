<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    /**
     * The model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'plat_nomor' => fake()->unique()->numerify('B######'),
            'jumlah_roda' => fake()->randomElement(['2', '4', '6', '8', '10']),
            'keterangan' => fake()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}