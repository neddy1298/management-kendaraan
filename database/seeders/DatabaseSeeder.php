<?php

namespace Database\Seeders;

use App\Models\Belanja;
use App\Models\GroupAnggaran;
use App\Models\Kendaraan;
use App\Models\LaporanBulanan;
use App\Models\LaporanTahunan;
use App\Models\Maintenance;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use App\Models\UnitKerja;
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


        // $path = storage_path('app/public/kendaraans.sql');
        // DB::unprepared(file_get_contents($path));
        // PaguAnggaran::factory()->count(1)->create();
        // LaporanTahunan::factory()->count(1)->create();
        // LaporanBulanan::factory()->count(12)->create();
        // MasterAnggaran::factory()->count(1)->create();
        // GroupAnggaran::factory()->count(10)->create();
        // UnitKerja::factory()->count(10)->create();
        // Kendaraan::factory()
        //     ->count(100)
        //     ->has(Maintenance::factory())
        //     ->create();
        // Belanja::factory()
        //     ->count(100)
        //     ->create();
    }
}
