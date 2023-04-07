<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Controllers\fetchKeyFromDatabase;
use Illuminate\Http\Request;

class fetchUpdateSubscribers extends Controller
{
    public function fetchUpdateSubscriber(Request $request)
    {
        // Retrieve the form data
        $subscriberId = $request->input('subscriberId');
        $email = $request->input('email');
        $name = $request->input('name');
        $country = $request->input('country');

        // Create the request body in the desired format
        $requestBody = [
        
            'fields' => [
                'email' => $email,
                'name' => $name,
                'country' => $country,
            ]
        ];

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

        $client->put("/api/v2/subscribers/$subscriberId", [
        'json' => $requestBody
    ]);

        return $requestBody;
    }
}
