<?php

namespace Database\Factories;

use App\Models\UnitKerja;
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

        $unitKerja = UnitKerja::get()->pluck('id')->toArray();

        return [
            'nomor_registrasi' => fake()->unique()->numerify('F####A'),
            'merk_kendaraan' => fake()->word(),
            'jenis_kendaraan' => fake()->randomElement(['Sedan', 'SUV', 'Hatchback', 'Minivan', 'Truck']),
            'unit_kerja_id' =>  $this->faker->randomElement($unitKerja),
            'cc_kendaraan' => fake()->numberBetween(100, 10000),
            'bbm_kendaraan' => fake()->randomElement(['Bensin', 'Diesel', 'Listrik']),
            'roda_kendaraan' => fake()->randomElement(['2', '4', '6', '8', '10']),
            'berlaku_sampai' => fake()->dateTimeBetween('-1 year', '+1 year')->format('d/m/y'),
        ];
    }
}