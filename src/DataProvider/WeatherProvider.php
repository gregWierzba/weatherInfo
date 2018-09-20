<?php

namespace App\DataProvider;

use App\Exception\OpenWeatherMapClientException;
use App\Model\Location;
use App\Model\Weather;
use App\Model\WeatherFactory;
use App\OpenWeatherMap\NearestCitiesWeatherRepository;
use App\OpenWeatherMap\Response\CitiesInCircleResponse;
use App\OpenWeatherMap\Response\City;

class WeatherProvider
{
    /**
     * @var NearestCitiesWeatherRepository
     */
    private $citiesWeatherRepository;

    const CITIES_LIMIT = 1;

    public function __construct(NearestCitiesWeatherRepository $citiesWeatherRepository)
    {
        $this->citiesWeatherRepository = $citiesWeatherRepository;
    }

    public function getCurrentWeather(Location $location)
    {
        $cityWeather = $this->getCityWeather($location);
        if (empty($cityWeather)) {
            return null;
        }

        return $this->prepareWeather($cityWeather);
    }

    private function prepareWeather(City $city): Weather
    {
        return WeatherFactory::create($city);
    }

    /**
     * @param Location $location
     * @return City|null
     */
    private function getCityWeather(Location $location): City
    {
        try {
            /** @var CitiesInCircleResponse $owmResponse */
            $owmResponse = $this->citiesWeatherRepository->getNearestCitiesWeather(
                $location->getLat(),
                $location->getLon(),
                self::CITIES_LIMIT
            );

            if (empty($owmResponse->getList())) {
                return null;
            }

            return $owmResponse->getList()[0];
        } catch (OpenWeatherMapClientException $clientException) {
            return null;
        }
    }
}