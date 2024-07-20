<?php

namespace Database\Factories;

use App\Models\KepalaKeluarga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $kepalaKeluarga = KepalaKeluarga::factory()->create();
        $kepalaKeluarga = KepalaKeluarga::get()->pluck('nkk')->toArray();

        return [
            'nik' => $this->faker->unique()->numerify('3################'),
            // 'nkk' => $this->faker->randomElement($KepalaKeluarga),
            'nkk' => $this->faker->randomElement($kepalaKeluarga),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'alamat' => $this->faker->address,
            'rt' => $this->faker->numerify('##'),
            'rw' => $this->faker->numerify('##'),
            'kelurahan_desa' => $this->faker->citySuffix,
            'kecamatan' => $this->faker->citySuffix,
            'kabupaten' => $this->faker->city,
            'provinsi' => $this->faker->state,
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'status' => $this->faker->randomElement(['Kawin', 'Belum Kawin']),
            'pekerjaan' => $this->faker->jobTitle,
            'kewarganegaraan' => 'WNI',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
