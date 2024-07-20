<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
// Schedule::command('whatsapp:send')->everyMinute();
Schedule::command('whatsapp:send')->daily()->at('09:00')->timezone('Asia/Jakarta');

