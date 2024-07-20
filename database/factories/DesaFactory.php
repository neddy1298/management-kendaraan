<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desa>
 */
class DesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::pluck('id')->toArray();

        return [
            'kode_desa' => $this->faker->unique()->bothify('##'),
            'nama_desa' => $this->faker->word(),
            'kode_kecamatan' => $this->faker->numerify('##'),
            'nama_kecamatan' => $this->faker->word(),
            'kode_kabupaten' => $this->faker->numerify('##'),
            'nama_kabupaten' => $this->faker->word(),
            'kode_provinsi' => $this->faker->numerify('##'),
            'nama_provinsi' => $this->faker->word(),
            'alamat_kantor' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'kode_pos' => $this->faker->postcode(),
            'nama_kepala_desa' => $this->faker->name(),
            'nip_kepala_desa' => $this->faker->numerify('################'),
            'nama_sekretaris_desa' => $this->faker->name(),
            'nip_sekretaris_desa' => $this->faker->numerify('################'),
            'nama_bendahara_desa' => $this->faker->name(),
            'user_id' => $this->faker->randomElement($user_id),
        ];
    }
}
