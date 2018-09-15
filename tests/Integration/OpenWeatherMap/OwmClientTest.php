<?php

namespace App\Tests\Integration\OpenWeatherMap;


use App\OpenWeatherMap\Client\RestClient;
use App\OpenWeatherMap\OwmClient;
use App\OpenWeatherMap\Response\CitiesInCircleResponse;
use App\OpenWeatherMap\Response\City;
use App\OpenWeatherMap\Response\WeatherDescription;
use App\OpenWeatherMap\Response\WeatherMain;
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
     * @see tests/mountebank/imposters/responses/owm_find_cities.json
     */
    public function it_gets_cities_weather()
    {
        $expectedResponseLimit = 3;
        /** @var CitiesInCircleResponse $response */
        $response = $this->owmClient->getNearestCitiesWeather(50.082961, 19.9373487, $expectedResponseLimit);

        $this->assertInstanceOf(CitiesInCircleResponse::class, $response);
        $this->assertCount($expectedResponseLimit, $response->getList());

        /** @var City $city */
        $city = $response->getList()[0];
        $this->assertInstanceOf(City::class, $city);
        $this->assertEquals(3094802, $city->getId());
        $this->assertEquals("Krakow", $city->getName());
        $this->assertArrayHasKey('lat', $city->getCoord());
        $this->assertArrayHasKey('lon', $city->getCoord());
        $this->assertInstanceOf(\DateTime::class, $city->getDate());

        /** @var WeatherMain $weatherMain */
        $weatherMain = $city->getMain();
        $this->assertInstanceOf(WeatherMain::class, $weatherMain);
        $this->assertEquals(287.15, $weatherMain->getTemp());
        $this->assertEquals(287.15, $weatherMain->getTempMax());
        $this->assertEquals(287.15, $weatherMain->getTempMin());
        $this->assertEquals(1023, $weatherMain->getPressure());
        $this->assertEquals(93, $weatherMain->getHumidity());

        /** @var WeatherDescription $weatherDesc */
        $weatherDesc = $city->getWeatherDesc()[0];
        $this->assertInstanceOf(WeatherDescription::class, $weatherDesc);
        $this->assertEquals(800, $weatherDesc->getId());
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