<?php

namespace App\DataProvider;

use App\Model\Location;
use App\Model\LocationData;

class LocationDataProvider
{
    /**
     * @var WeatherProvider
     */
    private $weatherProvider;

    public function __construct(WeatherProvider $weatherProvider)
    {
        $this->weatherProvider = $weatherProvider;
    }

    public function getCurrentDataForLocation(Location $location): LocationData
    {
        $weatherData = $this->weatherProvider->getCurrentWeather($location);
        return new LocationData($weatherData);
    }
}