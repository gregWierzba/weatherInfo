<?php

namespace App\Tests\Unit\DataProvider;

use App\DataProvider\LocationDataProvider;
use App\DataProvider\WeatherProvider;
use App\Model\Location;
use App\Model\LocationData;
use App\Model\Weather;
use PHPUnit\Framework\TestCase;

class LocationDataProviderTest extends TestCase
{
    /**
     * @var LocationDataProvider
     */
    private $locationDataProvider;

    /**
     * @var WeatherProvider
     */
    private $weatherProvider;

    public function setUp()
    {
        $this->weatherProvider = $this->getMockBuilder(WeatherProvider::class)
            ->disableOriginalConstructor()
            ->setMethods(['getCurrentWeather'])
            ->getMock();

        $this->locationDataProvider = new LocationDataProvider($this->weatherProvider);
    }

    public function testGetCurrentDataForLocation()
    {
        $lat = 50.082961;
        $lon = 19.937348;

        $location = new Location($lat, $lon);

        $currentWeather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->weatherProvider->expects($this->once())
            ->method('getCurrentWeather')
            ->with(
                $this->identicalTo($location)
            )
            ->will($this->returnValue($currentWeather));

        /** @var LocationData $data */
        $data = $this->locationDataProvider->getCurrentDataForLocation($location);
        $this->assertInstanceOf(LocationData::class, $data);
        $this->assertInstanceOf(Weather::class, $data->getCurrentWeather());
    }
}