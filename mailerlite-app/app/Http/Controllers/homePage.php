<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class homePage extends Controller
{
    public function validateAndSaveApiKey(Request $request)
    {
        while (true) {
            $apiKey = $request->input('api-key');
            if (!$apiKey) {
                return view('validateAndSaveApiKey', ['error' => 'API key is required.']);
            } else {
                break;
            }
        }

        $url = 'https://api.mailerlite.com';

        // Set up the HTTP client
        $client = new Client([
            'verify' => false,
            'base_uri' => $url,
            'headers' => [
                'X-MailerLite-ApiKey' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        
        if ($request->has('validate')) {
            try {
                $client->get('/api/v2/stats');
                $pdo = new PDO('mysql:host=localhost;dbname=mailerliteapp', 'root', 'rootroot');

                // Prepare the SQL statement to select the API key from the database
                $stmt = $pdo->prepare('SELECT api_key FROM api_keys WHERE api_key IS NOT NULL');
                $stmt->execute();

                // Fetch the API key from the result set
                $apiKeyInDatabase = $stmt->fetchColumn();

                if ($apiKeyInDatabase) {
                    // API key exists in the database, use it
                    $apiKey = $apiKeyInDatabase;
                    return redirect('/subscribers');
                } else {
                    // API key doesn't exist in the database, insert it
                    $stmt = $pdo->prepare('INSERT INTO api_keys (api_key) VALUES (:api_key)');
                    $stmt->bindParam(':api_key', $apiKey);
                    $stmt->execute();
                    return redirect('/subscribers');
                }
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $responseBody = $e->getResponse()->getReasonPhrase();
                    if ($statusCode >= 400 && $statusCode <= 599) {
                        // API key is invalid, show error message and return to the same page
                        return view('validateAndSaveApiKey', ['error' => "Reason : $statusCode : $responseBody"]);
                    }
                }
            }
        }

        // Show the form with the "Validate" button
        return view('validateAndSaveApiKey');
    }
    
    public function showSubscribersPage()
    {
        return view('listSubscribers');
    }
}
