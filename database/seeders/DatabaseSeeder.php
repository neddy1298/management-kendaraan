<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use App\Models\Maintenance;
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
            'role' => 'admin',
        ]);
<<<<<<< HEAD
=======

        // $path = storage_path('app/public/tbl_kendaraan.sql');
        // DB::unprepared(file_get_contents($path));
        Kendaraan::factory()
        ->count(100)
        ->has(Maintenance::factory())
        ->create();
>>>>>>> 2190a9700c1477bfec5d2c3360993f6ede49b71a
    }
}
