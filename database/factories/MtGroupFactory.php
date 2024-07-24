<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\MtGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MtGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MtGroup::class;

    public function definition(): array
    {

        return [
            'bahan_bakar_minyak' => fake()->randomElement(['2', '3', '5', 'lainnya']),
            'pelumas_mesin' => fake()->randomElement(['1', '2', 'lainnya']),
            'suku_cadang' => $this->faker->optional()->word(),
            
            'budget_bahan_bakar_minyak' => fake()->numberBetween(100000, 10000000),
            'budget_pelumas_mesin' => fake()->numberBetween(100000, 10000000),
            'budget_suku_cadang' => fake()->numberBetween(100000, 10000000),
        ];
    }
}
