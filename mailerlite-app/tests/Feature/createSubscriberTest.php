<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createSubscriberTest extends TestCase
{
    public function testCreateSubscriber()
    {
        // Set up the test data
        $email = 'test@example.com';
        $name = 'Test User';
        $country = 'US';

        // Send a POST request to the create subscriber route with the test data
        $response = $this->post('/createSubscribers', [
            'email' => $email,
            'name' => $name,
            'country' => $country,
        ]);

        // Assert that the response is successful and contains a JSON success field set to true
        $response->assertSuccessful();
        $response->assertJson(['success' => true]);
    }
}
