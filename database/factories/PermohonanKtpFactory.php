<?php

namespace Database\Factories;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermohonanKtp>
 */
class PermohonanKtpFactory extends Factory
{
    /**
     * The model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $penduduk = Penduduk::get()->pluck('nik')->toArray();

        return [
            'nik' => fake()->randomElement($penduduk),
            'jenis_permohonan' => fake()->randomElement(['Baru', 'Perpanjangan', 'Penggantian']),
            'keterangan' => fake()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}