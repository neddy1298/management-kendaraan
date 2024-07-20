<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanKtp;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // PermohonanKtp::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        Desa::factory(1)->create();
        KepalaKeluarga::factory(50)->create();
        Penduduk::factory(100)->create();
        PermohonanKtp::factory(30)->create();
    }
}
