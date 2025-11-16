<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiTest extends TestCase
{
    private HttpClientInterface $client;

    public function setUp(): void
    {
        $this->client = new CurlHttpClient();
    }

    public function testUserApiReturnsUsers(): void
    {
        $response = $this->client->request('GET', 'http://localhost:8000/users');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = $response->toArray();

        $this->assertNotNull($data);
        $this->assertIsArray($data);

        if (is_array($data) && isset($data[0])) {
            $this->assertIsArray($data[0]);

            $this->assertArrayHasKey('name', $data[0]);
            $this->assertArrayHasKey('email', $data[0]);

            $this->assertNotEmpty($data[0]['name']);
            $this->assertNotEmpty($data[0]['email']);

            $this->assertIsString($data[0]['name']);
            $this->assertIsString($data[0]['email']);
        }
    }
}
