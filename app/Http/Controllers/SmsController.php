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
     * Send a WhatsApp message using Vonage API.
     *
     * @param string $message The message to be sent.
     * @return array The response from the API.
     */

    // Using Twilio API
    public function sendWhatsapp()
    {
        $expireKendaraans = Kendaraan::where('berlaku_sampai', '<', Carbon::now())->get();

        $message = 'Pengingat ' . Carbon::now()->isoFormat('D MMMM YYYY') . ', berikut adalah kendaraan yang sudah kadaluarsa:' . "\n";
        foreach ($expireKendaraans as $index => $kendaraan) {
            $message .= "\n" . $index + 1 . '. ' . $kendaraan->nomor_registrasi . ' - ' . $kendaraan->berlaku_sampai->format('d/m/Y');
        }

        $message .= "\n\n" . "Segera perpanjang kendaraan yang sudah kadaluarsa.";
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+6285156678113", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => $message
                ]
            );
        // $verification_check = $twilio->verify->v2
        //     ->services("VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
        //     ->verificationChecks->create([
        //         "to" => "+15017122661",
        //         "code" => "123456",
        //     ]);

        if ($message->sid) {
            // return redirect()->route('kendaraan.index')->with('success', 'Pesan WhatsApp berhasil dikirim');
            return ['status' => 'success'];
        } else {
            // return redirect()->route('kendaraan.index')->with('error', 'Pesan WhatsApp gagal dikirim');
            return ['status' => 'error', 'error' => $message->errorMessage];
        }
        // return print $verification_check->status;
    }
}
