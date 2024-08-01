<?php

namespace Database\Factories;

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
        return [
            'kode_rekening' => $this->faker->unique()->numerify('#.#.#.#'),
            'nama_rekening' => $this->faker->unique()->word(),
            'anggaran' => fake()->numerify('##00000000'),
        ];
    }
}
