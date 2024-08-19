<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TargetedYearlyBackup extends Command
{
    protected $signature = 'db:targeted-yearly-backup';
    protected $description = 'Create a yearly backup of specific tables';

    protected $tablesToBackup = [
        'pagu_anggarans',
        'master_anggarans',
        'group_anggarans',
        'kendaraans',
        'group_anggaran_kendaraan',
    ];

    public function handle()
    {
        $currentYear = date('Y');
        $newDatabaseName = env('DB_DATABASE') . '_' . $currentYear;

        // Check if backup already exists
        if ($this->backupExists($newDatabaseName)) {
            $this->error("Backup for year $currentYear already exists. Aborting.");
            return;
        }

        // Create new database
        DB::statement("CREATE DATABASE IF NOT EXISTS $newDatabaseName");

        foreach ($this->tablesToBackup as $tableName) {
            if (Schema::hasTable($tableName)) {
                // Copy structure
                DB::statement("CREATE TABLE $newDatabaseName.$tableName LIKE " . env('DB_DATABASE') . ".$tableName");
                
                // Copy data
                DB::statement("INSERT INTO $newDatabaseName.$tableName SELECT * FROM " . env('DB_DATABASE') . ".$tableName");
                
                // Clear data from current table
                DB::table($tableName)->truncate();
                
                $this->info("Backed up and cleared table: $tableName");
            } else {
                $this->warn("Table $tableName does not exist. Skipping.");
            }
        }

        $this->info("Targeted yearly backup completed. New database created: $newDatabaseName");
    }

    private function backupExists($databaseName)
    {
        $result = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$databaseName]);
        return !empty($result);
    }
}