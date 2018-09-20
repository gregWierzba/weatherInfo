<?php

namespace App\Tests\Unit\DataProvider;

use App\DataProvider\WeatherProvider;
use App\Model\Location;
use App\Model\Weather;
use App\OpenWeatherMap\NearestCitiesWeatherRepository;
use App\OpenWeatherMap\Response\CitiesInCircleResponse;
use App\OpenWeatherMap\Response\City;
use App\OpenWeatherMap\Response\WeatherDescription;
use App\OpenWeatherMap\Response\WeatherMain;
use PHPUnit\Framework\TestCase;

class WeatherProviderTest extends TestCase
{
    /**
     * @var NearestCitiesWeatherRepository
     */
    private $citiesWeatherRepository;

    /**
     * @var WeatherProvider
     */
    private $weatherProvider;

    /**
     * @var CitiesInCircleResponse
     */
    private $weatherResponse;

    public function setUp()
    {
        $this->citiesWeatherRepository = $this->getMockBuilder(NearestCitiesWeatherRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['getNearestCitiesWeather'])
            ->getMock();

        $cityResponse = $this->getMockBuilder(City::class)
            ->setMethods(['getWeatherDesc', 'getMain'])
            ->getMock();

        $weatherDesc = $this->getMockBuilder(WeatherDescription::class)
            ->setMethods(['getId'])
            ->getMock();

        $weatherDesc->expects($this->once())
            ->method('getId')
            ->will($this->returnValue(800));

        $cityResponse->expects($this->once())
            ->method('getWeatherDesc')
            ->will($this->returnValue([$weatherDesc]));

        $weatherMain = $this->getMockBuilder(WeatherMain::class)
            ->setMethods(['getTemp', 'getPressure', 'getHumidity'])
            ->getMock();

        $weatherMain->expects($this->once())
            ->method('getTemp')
            ->will($this->returnValue(25.22));
        $weatherMain->expects($this->once())
            ->method('getPressure')
            ->will($this->returnValue(1020));
        $weatherMain->expects($this->once())
            ->method('getHumidity')
            ->will($this->returnValue(90));

        $cityResponse->expects($this->exactly(3))
            ->method('getMain')
            ->will($this->returnValue($weatherMain));

        $this->weatherResponse = $this->getMockBuilder(CitiesInCircleResponse::class)
            ->disableOriginalConstructor()
            ->setMethods(['getList'])
            ->getMock();

        $this->weatherResponse->expects($this->atLeastOnce())
            ->method('getList')
            ->will($this->returnValue([$cityResponse]));

        $this->weatherProvider = new WeatherProvider($this->citiesWeatherRepository);
    }

    public function testGetCurrentWeather()
    {
        $lat = 50.082961;
        $lon = 19.937348;

        $this->citiesWeatherRepository->expects($this->once())
            ->method('getNearestCitiesWeather')
            ->with(
                $this->identicalTo($lat),
                $this->identicalTo($lon)
            )
            ->will($this->returnValue($this->weatherResponse));

        $location = new Location($lat, $lon);
        $weather = $this->weatherProvider->getCurrentWeather($location);

        $this->assertInstanceOf(Weather::class, $weather);
    }
}