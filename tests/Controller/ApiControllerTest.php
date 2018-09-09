<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetData()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1.0/current');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $expectedResponseBody = [
            'weather' => [
                'general' => 500,
                'temp' => 28.5,
                'pressure' => 1013.75,
                'humidity' => 90
            ],
            'wind' => [
                'speed' => 5.85,
                'deg' => 289
            ],
            'clouds' => 75,
            'rain' => 3
        ];

        $responseBody = json_decode($response->getContent(), true);

        try {
            $this->assertEquals($expectedResponseBody, $responseBody);
        } catch (PHPUnit_Framework_ExpectationFailedException $e) {
            echo $e->getComparisonFailure()->toString();
        }
    }
}