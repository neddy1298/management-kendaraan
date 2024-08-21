<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function performBackup()
    {
        try {
            Artisan::call('db:targeted-yearly-backup');
            $output = Artisan::output();

            if (strpos($output, 'already exists') !== false) {
                return redirect()->back()->with('warning', 'Backup for this year already exists.');
            }

            return redirect()->back()->with('success', 'Backup completed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }
}
