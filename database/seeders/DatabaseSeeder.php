<?php

namespace Database\Seeders;

use App\Models\Belanja;
use App\Models\GroupAnggaran;
use App\Models\Kendaraan;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);


        // $path = storage_path('app/public/db_management_kendaraan.sql');
        // DB::unprepared(file_get_contents($path));
        // PaguAnggaran::factory()->count(1)->create();
        // MasterAnggaran::factory()->count(5)->create();
        // GroupAnggaran::factory()->count(10)->create();
        // Kendaraan::factory()
        //     ->count(100)
        //     ->create();
        // Belanja::factory()
        //     ->count(1000)
        //     ->create();
    }
}
