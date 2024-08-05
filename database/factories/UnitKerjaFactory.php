<?php

namespace Database\Factories;

use App\Models\GroupAnggaran;
use App\Models\UnitKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnitKerja>
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
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (UnitKerja $unitKerja) {
            $groupAnggarans = GroupAnggaran::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $unitKerja->groupAnggarans()->attach($groupAnggarans);
        });
    }
}
