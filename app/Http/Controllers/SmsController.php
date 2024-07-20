<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function sendWhatsapp($message)
    {
        // Using vonage API
        $url = env('VONAGE_URL');
        $username = env('VONAGE_USERNAME');
        $password = env('VONAGE_PASSWORD');
        $cacertPath = storage_path('cacert.pem'); // Update this path to where you saved cacert.pem

        // dump($message);

        $response = Http::withBasicAuth($username, $password)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])
            ->withOptions([
                'verify' => $cacertPath,
            ])
            ->post($url, [
                'from' => env('VONAGE_NUMBER'),
                'to' => env('WHATSAPP_NUMBER'),
                'message_type' => 'text',
                'text' => $message,
                'channel' => 'whatsapp'
            ]);

        // return $response->json();
        if ($response->successful()) {
            return ['status' => 'success'];
        } else {
            return ['error' => 'API request failed'];
        }
    }

    public function sendSms()
    {

    // Example using Vonage
    $basic  = new \Vonage\Client\Credentials\Basic(env('VONAGE_USERNAME'), env('VONAGE_PASSWORD'));
    $client = new \Vonage\Client($basic);

    // Set the CA bundle path for Guzzle with a relative path
    $guzzleClient = new \GuzzleHttp\Client([
    'verify' => storage_path('cacert.pem'),
    ]);
            $client->setHttpClient($guzzleClient);

        $message = $client->sms()->send(
            new \Vonage\SMS\Message\SMS(env('WHATSAPP_NUMBER'), "Contoh Text", 'Ini adalah contoh SMS')
        );

        // Return a response
        return response()->json(['message' => 'SMS sent successfully']);
    }
}
