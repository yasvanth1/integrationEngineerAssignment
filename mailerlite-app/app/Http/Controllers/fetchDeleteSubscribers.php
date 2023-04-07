<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Controllers\fetchKeyFromDatabase;
use Illuminate\Http\Request;

class fetchDeleteSubscribers extends Controller
{
    public function fetchDeleteSubscriber(Request $request)
    {
        // Retrieve the form data
        $subscriberId = $request->input('subscriberId');

        $fetchKey = new fetchKeyFromDatabase();
        $apiKey = $fetchKey->fetchKeyFromDatabase();

        $url = 'https://api.mailerlite.com';
        $client = new Client([
            'verify' => false,
            'base_uri' => $url,
            'headers' => [
                'X-MailerLite-ApiKey' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        try {
            $response = $client->delete("/api/v2/subscribers/$subscriberId");
            $success = $response->getStatusCode() == 204;
        } catch (\Exception $e) {
            // Return the error message as a JSON response
            return response()->json(['success' => false, 'message' => 'Failed to delete subscriber.', 'subscriberId' => $subscriberId]);
        }

        // Return a JSON boolean response indicating success or failure
        return response()->json(['success' => $success]);
    }
}
