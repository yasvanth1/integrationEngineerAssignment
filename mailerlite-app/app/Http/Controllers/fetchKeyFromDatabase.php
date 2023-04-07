<?php

namespace App\Http\Controllers;

use PDO;

class fetchKeyFromDatabase extends Controller
{
    public function fetchKeyFromDatabase()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=mailerliteapp', 'root', 'rootroot');

        // Prepare the SQL statement to select the API key from the database
        $stmt = $pdo->prepare('SELECT api_key FROM api_keys WHERE api_key IS NOT NULL');
        $stmt->execute();

        // Fetch the API key from the result set
        $apiKeyInDatabase = $stmt->fetchColumn();

        // API key exists in the database, use it
        $apiKey = $apiKeyInDatabase;
        //return the apiKey so it can be used by other controllers
        $apiKey = $apiKeyInDatabase;
        return $apiKey;
    }
}
