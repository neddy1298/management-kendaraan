<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaguAnggaran>
 */
class PaguAnggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_rekening' => $this->faker->unique()->numerify('#.#.#.#'),
            'nama_rekening' => $this->faker->unique()->word(),
            'anggaran' => $this->faker->numerify('##00000000'),
            'tahun' => $this->faker->unique()->year(),
        ];
    }
}
