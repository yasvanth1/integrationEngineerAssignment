<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\fetchKeyFromDatabase;

class fetchSubscriberList extends Controller
{
    public function showSubscribersList()
    {
        $fetchKey = new fetchKeyFromDatabase();
        $apiKey = $fetchKey->fetchKeyFromDatabase();
        // Retrieve the MailerLite API key from the database
        $apiKey = DB::table('api_keys')->whereNotNull('api_key')->value('api_key');

        // Set up the Guzzle client
        $client = new Client([
            'verify' => false,
            'base_uri' => 'https://api.mailerlite.com',
            'headers' => [
                'X-MailerLite-ApiKey' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        // Fetch subscribers data from the MailerLite API with pagination
        $response = $client->get("/api/v2/subscribers");

        // Decode the JSON response
        $responseData = json_decode($response->getBody(), true);

        // Extract the subscribers' data from the response
        $subscribers = collect($responseData)->map(function ($subscriber) {
            return [

                'email' => $subscriber['email'],
                'subscriberId' => (string)$subscriber['id'],
                'name' => $subscriber['name'],
                'country' => $subscriber['fields'][2]['value'] ?? null,
                'date_subscribe' => date('d/m/Y', strtotime($subscriber['date_subscribe'])),
                'date_created' => date('H:i:s', strtotime($subscriber['date_created'])),

            ];
        });

        $total = count($responseData);

        return response()->json([
            'data' => $subscribers,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
        ])->content();
    }
}
