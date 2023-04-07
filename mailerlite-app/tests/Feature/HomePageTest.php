<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PDO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function testHomePageLoads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Validate API Key');
    }

public function testApiKeyRequired()
{
    $response = $this->get('/', ['validate' => '']);
    $response->assertSee('API key is required.');
}

public function testValidApiKeyRedirect()
{
    $response = $this->get('/subscribers');

    $response->assertStatus(200);
    $response->assertViewIs('listSubscribers');
}
}
