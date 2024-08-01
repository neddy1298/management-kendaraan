<?php

namespace Database\Factories;

use App\Models\MasterAnggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupAnggaran>
 */
class GroupAnggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $masterAnggaran = MasterAnggaran::get()->pluck('id')->toArray();

        return [
            'nama_group' => $this->faker->unique()->word(),
            'kode_rekening' => $this->faker->unique()->numerify('#.#.#.#'),
            'master_anggaran_id' => $this->faker->randomElement($masterAnggaran),
            'anggaran_bahan_bakar_minyak' => fake()->numerify('##00000000'),
            'anggaran_pelumas_mesin' => fake()->numerify('##00000000'),
            'anggaran_suku_cadang' => fake()->numerify('##00000000'),

        ];
    }
}
