<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    /**
     * Send a WhatsApp message using Twilio API.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendWhatsapp()
    {
        $expireKendaraans = Kendaraan::where('berlaku_sampai', '<', Carbon::now())->get();
        $message = $this->generateMessage($expireKendaraans);

        try {
            $this->sendMessage($message);
            return redirect()->back()->with('success', 'Pesan WhatsApp berhasil dikirim');
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp message: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Pesan WhatsApp gagal dikirim: ' . $e->getMessage());
        }
    }

    /**
     * Generate the message content.
     *
     * @param \Illuminate\Database\Eloquent\Collection $expireKendaraans
     * @return string
     */
    protected function generateMessage($expireKendaraans)
    {
        $message = 'Pengingat ' . Carbon::now()->isoFormat('D MMMM YYYY') . ', berikut adalah kendaraan yang sudah kadaluarsa:' . "\n";
        foreach ($expireKendaraans as $index => $kendaraan) {
            $message .= "\n" . ($index + 1) . '. ' . $kendaraan->nomor_registrasi . ' - ' . $kendaraan->berlaku_sampai->format('d/m/Y');
        }
        $message .= "\n\n" . "Segera perpanjang kendaraan yang sudah kadaluarsa.";
        return $message;
    }

    /**
     * Send the message using Twilio API.
     *
     * @param string $message
     * @throws \Twilio\Exceptions\TwilioException
     */
    protected function sendMessage($message)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);

        $twilio->messages->create(
            "whatsapp:" . env("TWILIO_RECEIVER"), // to
            [
                "from" => "whatsapp:+14155238886",
                "body" => $message
            ]
        );
    }
}
