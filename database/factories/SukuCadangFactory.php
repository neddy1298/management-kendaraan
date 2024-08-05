<?php

namespace Database\Factories;

use App\Models\Belanja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SukuCadang>
 */
class SukuCadangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $belanjas = Belanja::get()->pluck('id')->toArray();

        return [
            'belanja_id' => $this->faker->randomElement($belanjas),
            'nama_suku_cadang' => $this->faker->word(),
            'jumlah' => $this->faker->randomNumber(2),
            'harga_satuan' => $this->faker->numerify('##00000000'),
        ];
    }
}
