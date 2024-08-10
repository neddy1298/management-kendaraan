<?php

namespace App\Console\Commands;

use App\Http\Controllers\SmsController;
use App\Models\Kendaraan;
use Illuminate\Console\Command;

class SendMaintenanceNotification extends Command
{
    protected $signature = 'whatsapp:send';

    protected $description = 'Send WhatsApp notifications to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $kendaran = Kendaraan::where('berlaku_sampai', '<', now())->get();

        if ($kendaran->count() == 0) {
            $this->info('No vehicles require maintenance.');
            return;
        }
        $smsController = new SmsController();
        $response = $smsController->sendWhatsapp();

        if (isset($response['status']) && $response['status'] == 'success') {
            $this->info('WhatsApp message sent successfully.');
        } else {
            $this->error('Failed to send WhatsApp message.');
            if (isset($response['error'])) {
                $this->error('Error: ' . $response['error']);
            }
        }
    }
}
