<?php

namespace App\Model;

class LocationData
{
    /**
     * @var Weather
     */
    private $currentWeather;

    public function __construct(Weather $currentWeather)
    {
        $this->currentWeather = $currentWeather;
    }

    public function getCurrentWeather(): Weather
    {
        return $this->currentWeather;
    }
}