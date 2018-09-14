<?php

namespace App\Tests\Integration\OpenWeatherMap;


use App\OpenWeatherMap\Client\RestClient;
use App\OpenWeatherMap\OwmClient;
use App\OpenWeatherMap\Response\CitiesInCircleResponse;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class OwmClientTest extends TestCase
{
    /**
     * @var OwmClient
     */
    private $owmClient;

    const BASE_HOST = 'http://mountebank:9090';
    const CITIES_ENDPOINT = '/data/2.5/find';
    const API_KEY = 'test_api_key';

    /**
     * @before
     */
    public function setup()
    {
        $this->prepareClient();
    }

    /**
     * @test
     */
    public function it_gets_cities_weather()
    {
        $expectedResponseLimit = 3;
        /** @var CitiesInCircleResponse $response */
        $response = $this->owmClient->getNearestCitiesWeather(50.082961, 19.9373487, $expectedResponseLimit);

        $this->assertInstanceOf(CitiesInCircleResponse::class, $response);
        $this->assertCount($expectedResponseLimit, $response->getList());
    }

    private function prepareClient()
    {
        $this->owmClient = new OwmClient(
            new RestClient(new Client()),
            SerializerBuilder::create()->build(),
            self::BASE_HOST,
            self::CITIES_ENDPOINT,
            self::API_KEY
        );
    }

}