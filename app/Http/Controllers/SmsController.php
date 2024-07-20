<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function sendWhatsapp($message)
    {
        // Using vonage API
        $url = 'https://messages-sandbox.nexmo.com/v1/messages';
        $username = '5a33e442';
        $password = 'bxkdBERH9QuLwNHV';
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
                'from' => '14157386102',
                'to' => '6285156678113',
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
    $basic  = new \Vonage\Client\Credentials\Basic('5a33e442', 'bxkdBERH9QuLwNHV');
    $client = new \Vonage\Client($basic);

    // Set the CA bundle path for Guzzle with a relative path
    $guzzleClient = new \GuzzleHttp\Client([
    'verify' => storage_path('cacert.pem'),
    ]);
            $client->setHttpClient($guzzleClient);

        $message = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("6282125241014", "Contoh Text", 'Ini adalah contoh SMS')
        );

        // Return a response
        return response()->json(['message' => 'SMS sent successfully']);
    }
}
