<?php

namespace Database\Factories;

use App\Models\UnitKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UnitKerjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UnitKerja::class;

    public function definition(): array
    {

        return [
            'nama_unit_kerja' => $this->faker->unique()->word(),            
            'budget_bahan_bakar_minyak' => fake()->numerify('##000000'),
            'budget_pelumas_mesin' => fake()->numerify('##000000'),
            'budget_suku_cadang' => fake()->numerify('##000000'),
        ];
    }
}
