<?php

namespace App\Console\Commands;

use App\Http\Controllers\SmsController;
use App\Models\Kendaraan;
use Illuminate\Console\Command;
// use App\Models\Vehicle;
use App\Models\User;
use App\Notifications\MaintenanceNotification;

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
        $message = 'This is a scheduled maintenance reminder. now is: ' . now();
        $smsController = new SmsController();
        $response = $smsController->sendWhatsapp($message);

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
