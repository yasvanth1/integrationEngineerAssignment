<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\fetchKeyFromDatabase;
use Illuminate\Http\Request;

class fetchCreateSubscribers extends Controller
{
    public function fetchCreateSubscriber(Request $request)
    {
        // Fetch API key from database
        $fetchKey = new fetchKeyFromDatabase();
        $apiKey = $fetchKey->fetchKeyFromDatabase();

        // Set up the HTTP client
        $client = new Client([
            'verify' => false,
            'base_uri' => 'https://api.mailerlite.com',
            'headers' => [
                'X-MailerLite-ApiKey' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        // Create a new subscriber
        try {
            $response = $client->post('/api/v2/subscribers', [
                'json' => [
                    'email' => $request->input('email'),
                    'fields' => [
                        'name' => $request->input('name'),
                        'country' => $request->input('country')
                    ]
                ]
            ]);
            

            $statusCode = $response->getStatusCode();
            $success = $statusCode >= 200 && $statusCode <= 299;
        } catch (RequestException $e) {
            // Handle any errors that occur
            $success = false;
            $response = $e->getResponse();
        }
    
        // Return a JSON boolean response indicating success or failure
        return response()->json(['success' => $success]);
    }
}
