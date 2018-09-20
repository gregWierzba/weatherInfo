<?php

namespace App\Model;


use App\OpenWeatherMap\Response\City;

class WeatherFactory
{
    public static function create(City $cityResponse): Weather
    {
        return new Weather(
            $cityResponse->getWeatherDesc()[0]->getId(),
            $cityResponse->getMain()->getTemp(),
            $cityResponse->getMain()->getPressure(),
            $cityResponse->getMain()->getHumidity()
        );
    }
}