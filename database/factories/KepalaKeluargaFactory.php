<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepalaKeluarga>
 */
class KepalaKeluargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nkk' => $this->faker->unique()->numerify('3################'),
            'nama_kepala_keluarga' => $this->faker->name,
            'alamat' => $this->faker->address,
            'rt' => $this->faker->numerify('##'),
            'rw' => $this->faker->numerify('##'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
